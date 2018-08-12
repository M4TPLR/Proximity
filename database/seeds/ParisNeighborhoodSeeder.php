<?php

use Grimzy\LaravelMysqlSpatial\Types\MultiPolygon;

class ParisNeighborhoodSeeder extends BaseNeighborhoodSeeder
{
    /**
     * Index of the name column.
     */
    const COLUMN_INDEX_NAME = 10;

    /**
     * Index of the geometry column.
     */
    const COLUMN_INDEX_GEOMETRY = 0;

    /**
     * Name of the neighborhoods' city.
     */
    const CITY = 'Paris';

    /**
     * Path of the seed file relative to the `database` directory.
     */
    const DATABASE_FILE_PATH = 'seeds/flat-files/paris.csv';

    /**
     * If the file has a header row.
     */
    const HAS_HEADER_ROW = true;

    /**
     * If the neighborhood names should be converted to Title Case.
     */
    const USE_TITLE_CASE = false;

    /**
     * Run the database seeds.
     *
     * @throws \Throwable
     */
    public function run()
    {
        // resolve the path of the seed file
        $file_path = database_path(self::DATABASE_FILE_PATH);

        // seed the neighborhoods from the flat file
        $this->seedFromFlatFile($file_path,
            self::COLUMN_INDEX_NAME,
            self::COLUMN_INDEX_GEOMETRY,
            self::CITY,
            self::HAS_HEADER_ROW,
            self::USE_TITLE_CASE);
    }

    /**
     * Parses the geometry to a multipolygon from well-known text.
     *
     * @param mixed $geometry
     * @return \Grimzy\LaravelMysqlSpatial\Types\MultiPolygon
     */
    protected function parseGeometryToMultiPolygon($geometry): MultiPolygon
    {
        return MultiPolygon::fromWKT($geometry);
    }
}