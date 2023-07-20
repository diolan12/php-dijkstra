<?php
namespace Diolan12;

/**
 * A class that represents a network of cable routes.
 * Generated by OpenAI ChatGPT [Mar 14 Version](https://help.openai.com/en/articles/6825453-chatgpt-release-notes)
 */
class Dijkstra
{
    private $vertices = [];

    /**
     * Return Dijkstra's instance
     * @return \Diolan12\Dijkstra
     */
    public static function instance()
    {
        return new self();
    }

    /**
     * Add a vertex to the graph with its neighboring edges.
     *
     * @param string $name The name of the vertex.
     * @param array $edges An associative array representing the neighboring vertices and their edge weights.
     * @return \Diolan12\Dijkstra
     */
    public function addVertex($name, $edges)
    {
        $this->vertices[$name] = $edges;
        return $this;
    }

    /**
     * Add an edge between two vertices with a given weight.
     *
     * @param string $src The source vertex.
     * @param string $dest The destination vertex.
     * @param int $weight The weight or cost of the edge.
     * @return \Diolan12\Dijkstra
     */
    public function addEdge($src, $dest, $weight, $reversible = false)
    {
        $this->vertices[$src][$dest] = $weight;
        if ($reversible){
            $this->vertices[$dest][$src] = $weight;
        }
        return $this;
    }

    /**
     * Dijkstra's shortest path algorithm
     * [Wikipedia](https://en.wikipedia.org/wiki/Dijkstra%27s_algorithm)
     * @see https://en.wikipedia.org/wiki/Dijkstra%27s_algorithm
     * @throws \Exception
     */
    public function findShortestPath($start, $end)
    {
        $distances = [];
        $visited = [];
        $previous = [];

        foreach ($this->vertices as $vertex => $edges) {
            $distances[$vertex] = INF;
            $visited[$vertex] = false;
            $previous[$vertex] = null;
        }

        $distances[$start] = 0;

        if (!isset($visited[$end])) {
            throw new NoPathException('Route not found "' . $end . '"', $end);
        }
        while ($visited[$end] === false) {
            $current = null;
            $minDist = INF;

            foreach ($distances as $vertex => $dist) {
                if ($visited[$vertex] === false && $dist <= $minDist) {
                    $minDist = $dist;
                    $current = $vertex;
                }
            }

            foreach ($this->vertices[$current] as $neighbor => $cost) {
                $alt = $distances[$current] + $cost;

                if ($alt < $distances[$neighbor]) {
                    $distances[$neighbor] = $alt;
                    $previous[$neighbor] = $current;
                }
            }

            $visited[$current] = true;
        }

        $path = [];
        $current = $end;

        while ($current !== $start) {
            if ($current == null) {
                throw new NoPathException('Route not found "' . $end . '"', $end);
            }
            array_unshift($path, $current);
            $current = $previous[$current];
        }

        array_unshift($path, $start);

        return $path;
    }
}