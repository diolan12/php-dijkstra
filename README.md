# Dijkstra PHP Implementation

 PHP implementation for Dijkstra's algorithm

 Generated by OpenAI ChatGPT [Mar 14 Version](https://help.openai.com/en/articles/6825453-chatgpt-release-notes)

 See [Wikipedia](https://en.wikipedia.org/wiki/Dijkstra%27s_algorithm)

## Install

```cli
composer instal diolan12/dijkstra
```

## Usage

```php
$dijkstra = new Dijkstra();

// Add vertices and edges
$dijkstra->addVertex('A', array('B' => 3, 'C' => 2));
$dijkstra->addVertex('B', array('A' => 3, 'C' => 1, 'D' => 5));
$dijkstra->addVertex('C', array('A' => 2, 'B' => 1, 'D' => 6));
$dijkstra->addVertex('D', array('B' => 5, 'C' => 6));

$paths = $dijkstra->findShortestPath('A', 'D');
```
