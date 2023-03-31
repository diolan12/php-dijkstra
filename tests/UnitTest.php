<?php
namespace Tests;

use PHPUnit\Framework\TestCase;
use Diolan12\Dijkstra\Dijkstra;

class UnitTest extends TestCase {
    /**
     * Test Dijkstra class to find shortest path
     *
     * @return void
     */
    public function testShortestPath()
    {
        $dijkstra = new Dijkstra();

        // Add vertices and edges
        $dijkstra->addVertex('A', ['B' => 3, 'C' => 2]);
        $dijkstra->addVertex('B', ['A' => 3, 'C' => 1, 'D' => 5]);
        $dijkstra->addVertex('C', ['A' => 2, 'B' => 1, 'D' => 6]);
        $dijkstra->addVertex('D', ['B' => 5, 'C' => 6]);

        $paths = $dijkstra->findShortestPath('A', 'D');

        $this->assertEquals(3, count($paths));
        $this->assertEquals('A', $paths[0]);
        $this->assertEquals('C', $paths[1]);
        $this->assertEquals('D', $paths[2]);
    }
}