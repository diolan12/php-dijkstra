<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Diolan12\Dijkstra;
use Diolan12\NoPathException;

class UnitTest extends TestCase
{
    /**
     * Test Dijkstra class to find shortest path
     *
     * @return void
     */
    public function testCalculateDistance()
    {
        $london = (object) [
            'latitude' => 51.5287398,
            'longitude' => -0.2664049
        ];
        $newYork = (object) [
            'latitude' => 40.69754,
            'longitude' => -74.3093254
        ];

        $distanceInKm = calcDist($london->latitude, $london->longitude, $newYork->latitude, $newYork->longitude, 'km');
        $distanceInMi = calcDist($london->latitude, $london->longitude, $newYork->latitude, $newYork->longitude, 'mi');

        $this->assertEquals(5581.355485546551, $distanceInKm);
        $this->assertEquals(3468.3073877379993, $distanceInMi);
    }

    /**
     * Test Dijkstra class to find shortest path
     *
     * @return void
     */
    public function testShortestPath()
    {
        $dijkstra = Dijkstra::instance();

        // Add vertices and edges
        $dijkstra->addVertex('A', ['B' => 4, 'C' => 2]);
        $dijkstra->addVertex('B', ['A' => 4, 'C' => 1, 'D' => 4]);
        $dijkstra->addVertex('C', ['A' => 2, 'B' => 1, 'D' => 6]);
        $dijkstra->addEdge('D', 'B', 4)->addEdge('D', 'C', 6);

        $paths = $dijkstra->findShortestPath('A', 'D');

        $this->assertEquals(4, count($paths), 'Shortest path should be 4 array');
        $this->assertEquals('A', $paths[0], 'First node should be A');
        $this->assertEquals('C', $paths[1], 'Second node should be C');
        $this->assertEquals('B', $paths[2], 'Third node should be B');
        $this->assertEquals('D', $paths[3], 'Fourth node should be D');
    }

    /**
     * Test Dijkstra class instantiation with graph
     *
     * @return void
     */
    public function testGraphParam()
    {
        // Build graph
        $graph = [
            'A' => [
                'B' => 3,
                'C' => 2
            ],
            'B' => [
                'A' => 3,
                'C' => 1,
                'D' => 5
            ],
            'C' => [
                'A' => 2,
                'B' => 1,
                'D' => 6
            ],
            'D' => [
                'B' => calcDist(1, 3, 1, 6),
                'C' => 6
            ]
        ];

        $dijkstra = Dijkstra::instance($graph);

        $paths = $dijkstra->findShortestPath('A', 'D');

        $this->assertEquals(3, count($paths), 'Shortest path should be 3 array');
        $this->assertEquals('A', $paths[0], 'First node should be A');
        $this->assertEquals('C', $paths[1], 'First node should be C');
        $this->assertEquals('D', $paths[2], 'First node should be D');
    }

    /**
     * Test Dijkstra class using numerical node names
     *
     * @return void
     */
    public function testNumericalNames()
    {
        $graph = [
            1 => [
                2 => 7,
                3 => 9,
                6 => 14
            ]
        ];
        $dijkstra = Dijkstra::instance($graph);

        $dijkstra->addVertex(2, [1 => 7, 3 => 10, 4 => 15]);
        $dijkstra->addVertex(3, [1 => 9, 2 => 10, 4 => 11, 6 => 2]);
        $dijkstra->addEdge(4, 2, 16)->addEdge(4, 3, 11)->addEdge(4, 5, 6);
        $dijkstra->addEdge(5, 4, 6)->addEdge(5, 6, 9);
        $dijkstra->addEdge(6, 1, 14)->addEdge(6, 3, 2)->addEdge(6, 5, 9);

        $paths = $dijkstra->findShortestPath(1, 5);

        $this->assertEquals(4, count($paths), 'Node should be 3 array');
        $this->assertEquals(1, $paths[0], 'First node should be 1');
        $this->assertEquals(3, $paths[1], 'First node should be 3');
        $this->assertEquals(6, $paths[2], 'First node should be 6');
        $this->assertEquals(5, $paths[3], 'First node should be 5');
    }

    /**
     * Test Dijkstra findShortestPath exception
     *
     * @return void
     */
    public function testException()
    {
        $graph = [
            '1' => [
                '2' => 3,
                '3' => 2
            ]
        ];
        $dijkstra = Dijkstra::instance($graph);

        $dijkstra->addVertex('2', ['1' => 3, '3' => 1, '4' => 5]);
        $dijkstra->addVertex('3', ['1' => 2, '2' => 1, '4' => 6]);
        $dijkstra->addEdge('4', '2', calcDist(1, 3, 1, 6))->addEdge('4', '3', 6); // 5

        $this->expectException(NoPathException::class, 'Should be using custom exception');
        $this->expectExceptionMessage('Route not found "5"');

        $dijkstra->findShortestPath('1', '5');
    }
}
