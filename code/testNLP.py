import pandas as pd

# Đọc file CSV không có tên cột
file_path = 'reviews.csv'
df = pd.read_csv(file_path, header=None)

# Giả sử các review nằm ở cột đầu tiên
reviews = df[0].tolist()  # Lấy danh sách các review từ cột đầu tiên
