<?php
namespace Tests;

use PHPUnit\Framework\TestCase;
use Diolan12\Dijkstra\Dijkstra;

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
        $dijkstra->addVertex('A', ['B' => 3, 'C' => 2]);
        $dijkstra->addVertex('B', ['A' => 3, 'C' => 1, 'D' => 5]);
        $dijkstra->addVertex('C', ['A' => 2, 'B' => 1, 'D' => 6]);
        $dijkstra->addEdge('D', 'B', 5)->addEdge('D', 'C', 6);

        $paths = $dijkstra->findShortestPath('A', 'D');

        $this->assertEquals(3, count($paths));
        $this->assertEquals('A', $paths[0]);
        $this->assertEquals('C', $paths[1]);
        $this->assertEquals('D', $paths[2]);
    }
}