<?php

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Faker\Generator;

abstract class BaseSeeder extends Seeder
{
    protected $total = 50;
    protected static $pool = array();

    public function run()
    {
        $this->createMultiple($this->total);
    }

    protected function createMultiple($total , array $customValues = array())
    {
        for ($i = 0; $i < $total; $i++) {
            $this->create($customValues);
        }
    }

    abstract public function getModel();

    protected function create(array $customValues = array())
    {
        $values = $this->getDummyData(Faker::create() ,  $customValues);
        $values = array_merge($values , $customValues);
        return $this->addToPool($this->getModel()->create($values));
    }

    abstract function getDummyData(Generator $faker);

    protected function createFrom($seeder , array $customValues = array())
    {
        $seeder = new $seeder;
        return $seeder->create($customValues);
    }

    protected function getRandom($model)
    {
        if( ! $this->collectionExists($model)){
            throw new Exception ("The $model collection does not exists");
        }
        return  static::$pool[$model]->random();
    }

    private function addToPool($entity)
    {
        $reflection = new ReflectionClass($entity);
        $class = $reflection->getShortName();

        if( ! $this->collectionExists($class)){
            static::$pool[$class] = new Collection();
        }

        static::$pool[$class]->add($entity);
        return $entity;
    }

    /**
     * @param $class
     * @return bool
     */
    private function collectionExists($class)
    {
        return isset (static::$pool[$class]);
    }
}