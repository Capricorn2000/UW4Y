<?php
namespace MailPoetVendor\Twig\Profiler;
if (!defined('ABSPATH')) exit;
final class Profile implements \IteratorAggregate, \Serializable
{
 public const ROOT = 'ROOT';
 public const BLOCK = 'block';
 public const TEMPLATE = 'template';
 public const MACRO = 'macro';
 private $template;
 private $name;
 private $type;
 private $starts = [];
 private $ends = [];
 private $profiles = [];
 public function __construct(string $template = 'main', string $type = self::ROOT, string $name = 'main')
 {
 $this->template = $template;
 $this->type = $type;
 $this->name = \str_starts_with($name, '__internal_') ? 'INTERNAL' : $name;
 $this->enter();
 }
 public function getTemplate() : string
 {
 return $this->template;
 }
 public function getType() : string
 {
 return $this->type;
 }
 public function getName() : string
 {
 return $this->name;
 }
 public function isRoot() : bool
 {
 return self::ROOT === $this->type;
 }
 public function isTemplate() : bool
 {
 return self::TEMPLATE === $this->type;
 }
 public function isBlock() : bool
 {
 return self::BLOCK === $this->type;
 }
 public function isMacro() : bool
 {
 return self::MACRO === $this->type;
 }
 public function getProfiles() : array
 {
 return $this->profiles;
 }
 public function addProfile(self $profile) : void
 {
 $this->profiles[] = $profile;
 }
 public function getDuration() : float
 {
 if ($this->isRoot() && $this->profiles) {
 // for the root node with children, duration is the sum of all child durations
 $duration = 0;
 foreach ($this->profiles as $profile) {
 $duration += $profile->getDuration();
 }
 return $duration;
 }
 return isset($this->ends['wt']) && isset($this->starts['wt']) ? $this->ends['wt'] - $this->starts['wt'] : 0;
 }
 public function getMemoryUsage() : int
 {
 return isset($this->ends['mu']) && isset($this->starts['mu']) ? $this->ends['mu'] - $this->starts['mu'] : 0;
 }
 public function getPeakMemoryUsage() : int
 {
 return isset($this->ends['pmu']) && isset($this->starts['pmu']) ? $this->ends['pmu'] - $this->starts['pmu'] : 0;
 }
 public function enter() : void
 {
 $this->starts = ['wt' => \microtime(\true), 'mu' => \memory_get_usage(), 'pmu' => \memory_get_peak_usage()];
 }
 public function leave() : void
 {
 $this->ends = ['wt' => \microtime(\true), 'mu' => \memory_get_usage(), 'pmu' => \memory_get_peak_usage()];
 }
 public function reset() : void
 {
 $this->starts = $this->ends = $this->profiles = [];
 $this->enter();
 }
 public function getIterator() : \Traversable
 {
 return new \ArrayIterator($this->profiles);
 }
 public function serialize() : string
 {
 return \serialize($this->__serialize());
 }
 public function unserialize($data) : void
 {
 $this->__unserialize(\unserialize($data));
 }
 public function __serialize() : array
 {
 return [$this->template, $this->name, $this->type, $this->starts, $this->ends, $this->profiles];
 }
 public function __unserialize(array $data) : void
 {
 [$this->template, $this->name, $this->type, $this->starts, $this->ends, $this->profiles] = $data;
 }
}