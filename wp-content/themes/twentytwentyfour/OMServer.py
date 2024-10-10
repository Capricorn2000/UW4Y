from flask import Flask, request, jsonify
from transformers import BertTokenizer, BertForSequenceClassification
import torch
import pandas as pd
import os
import logging

# Cấu hình logging
logging.basicConfig(level=logging.INFO)

app = Flask(__name__)

# Tải mô hình và tokenizer cho BERT (phân tích cảm xúc)
model_name = "nlptown/bert-base-multilingual-uncased-sentiment"
tokenizer = BertTokenizer.from_pretrained(model_name)
model = BertForSequenceClassification.from_pretrained(model_name)

# Định nghĩa file CSV lưu điểm trước đó
previous_scores_file = 'previous_scores.csv'

# Hàm lấy điểm trước đó từ file CSV
def get_previous_sentiment(product_id):
    try:
        df = pd.read_csv(previous_scores_file)
        row = df[df['id sản phẩm'] == product_id]
        if not row.empty:
            return {
                "vận chuyển": row['vận chuyển'].values[0],
                "chất lượng sản phẩm": row['chất lượng sản phẩm'].values[0],
                "chất lượng phục vụ": row['chất lượng phục vụ'].values[0],
                "màu sắc": row['màu sắc'].values[0],
                "kích thước": row['kích thước'].values[0],
            }
    except Exception as e:
        logging.error(f"Error reading previous scores: {e}")
    
    # Nếu không tìm thấy, trả về điểm 0 cho tất cả các khía cạnh
    return {
        "vận chuyển": 0,
        "chất lượng sản phẩm": 0,
        "chất lượng phục vụ": 0,
        "màu sắc": 0,
        "kích thước": 0,
    }

# Định nghĩa từ khóa cho từng khía cạnh
aspects = {
    "vận chuyển": ["giao hàng", "vận chuyển", "ship", "nhanh", "chậm", "lâu"],
    "chất lượng sản phẩm": ["sản phẩm", "chất lượng", "xịn", "tốt", "kém", "bền", "dỏm", "ổn", "ok"],
    "chất lượng phục vụ": ["phục vụ", "dịch vụ", "chăm sóc khách hàng", "tư vấn", "nhiệt tình", "trả lời"],
    "màu sắc": ["màu sắc", "màu", "tươi", "đậm", "nhạt", "đúng"],
    "kích thước": ["kích cỡ", "size", "vừa", "lớn", "nhỏ"]
}

# Hàm phân tích cảm xúc
def analyze_sentiment(comment):
    inputs = tokenizer(comment, return_tensors='pt', padding=True, truncation=True, max_length=512)
    with torch.no_grad():
        outputs = model(**inputs)
    predictions = torch.argmax(outputs.logits, dim=-1).item()
    
    # Chuyển đổi dự đoán thành cảm xúc: 1 = tích cực, 0 = trung lập, -1 = tiêu cực
    if predictions == 0:
        return -1  # Tiêu cực
    elif predictions == 1:
        return 0  # Trung lập
    else:
        return 1  # Tích cực

# Hàm kiểm tra comment có đề cập đến khía cạnh nào không
def get_aspect_sentiment(comment, aspect_keywords):
    for keyword in aspect_keywords:
        if keyword in comment.lower():
            return analyze_sentiment(comment)
    return 0  # Không đề cập đến khía cạnh này (trả về giá trị 0)

# Hàm cập nhật file CSV với điểm mới
def update_csv(product_id, new_scores):
    try:
        # Đọc file CSV hiện có
        if os.path.exists(previous_scores_file):
            df = pd.read_csv(previous_scores_file)
        else:
            # Nếu file không tồn tại, tạo DataFrame mới
            df = pd.DataFrame(columns=["id sản phẩm", "vận chuyển", "chất lượng sản phẩm", "chất lượng phục vụ", "màu sắc", "kích thước"])

        # Tìm dòng tương ứng với sản phẩm
        if product_id in df['id sản phẩm'].values:
            df.loc[df['id sản phẩm'] == product_id, list(new_scores.keys())] = list(new_scores.values())
        else:
            # Nếu không tìm thấy, thêm dòng mới
            new_row = {"id sản phẩm": product_id}
            new_row.update(new_scores)
            df = df.append(new_row, ignore_index=True)

        # Ghi lại DataFrame vào file CSV
        df.to_csv(previous_scores_file, index=False)
    except Exception as e:
        logging.error(f"Error updating CSV: {e}")

# Endpoint API để phân tích cảm xúc từng khía cạnh
@app.route('/analyze', methods=['POST'])
def analyze():
    # Lấy dữ liệu từ request
    data = request.get_json()

    # Kiểm tra nếu không có comment hoặc product_id
    if not data or 'comment' not in data or 'product_id' not in data:
        error_message = "No comment or product_id provided"
        logging.error(error_message)
        return jsonify({"error": error_message}), 400

    comment = data.get('comment', '')
    product_id = data.get('product_id', '')

    # Nếu comment hoặc product_id rỗng, trả về lỗi
    if not comment or not product_id:
        error_message = "Comment or product_id cannot be empty"
        logging.error(error_message)
        return jsonify({"error": error_message}), 400

    # Lấy điểm trước đó cho từng khía cạnh
    previous_sentiment = get_previous_sentiment(product_id)

    # Phân tích từng khía cạnh và tính điểm tổng
    total_values = []
    new_scores = {}  # Lưu điểm mới cho từng khía cạnh
    for aspect, keywords in aspects.items():
        aspect_sentiment = get_aspect_sentiment(comment, keywords)
        # Cộng điểm mới vào điểm trước đó
        new_score = previous_sentiment[aspect] + aspect_sentiment
        total_values.append(new_score)
        new_scores[aspect] = new_score  # Lưu điểm mới vào dict

    # Tính điểm tổng (trung bình các khía cạnh)
    total = sum(total_values) / len(total_values) if total_values else 0

    # Cập nhật lại file CSV với điểm mới
    update_csv(product_id, new_scores)

    # Trả về tổng điểm
    return jsonify({"total": total})

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000)
