# Dijkstra PHP Implementation

[![PHP Composer](https://github.com/diolan12/dijkstra/actions/workflows/php.yml/badge.svg)](https://github.com/diolan12/dijkstra/actions/workflows/php.yml)
[![Downloads](https://img.shields.io/packagist/dt/diolan12/dijkstra)](https://packagist.org/packages/diolan12/dijkstra)
[![Latest Stable Version](https://img.shields.io/packagist/v/diolan12/dijkstra)](https://packagist.org/packages/diolan12/dijkstra)
[![License](https://img.shields.io/packagist/l/diolan12/dijkstra)](https://packagist.org/packages/diolan12/dijkstra)

 A simple PHP implementation for Dijkstra's algorithm

 Generated by OpenAI ChatGPT [Mar 14 Version](https://help.openai.com/en/articles/6825453-chatgpt-release-notes)

 See [Wikipedia](https://en.wikipedia.org/wiki/Dijkstra%27s_algorithm)

## Installation

```cli
composer require diolan12/dijkstra
```

## Usage

```php
use Diolan12\Dijkstra\Dijkstra;

$dijkstra = new Dijkstra();

// Add vertices and edges
$dijkstra->addVertex('A', ['B' => 3, 'C' => 2]);
$dijkstra->addVertex('B', ['A' => 3, 'C' => 1, 'D' => 5]);
$dijkstra->addVertex('C', ['A' => 2, 'B' => 1, 'D' => 6]);
$dijkstra->addVertex('D', ['B' => 5, 'C' => 6]);

$paths = $dijkstra->findShortestPath('A', 'D'); // [A, C, D]
```

## Dev Test

```cli
./vendor/bin/phpunit tests
```
