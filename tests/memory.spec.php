<?php

describe('ImmAssoc memory', function () {
    beforeEach(function () {
        // use the factory to create a Faker\Generator instance
        $faker = Faker\Factory::create();
        $dummies = [];
        for ($i=0; $i < 100000; $i++) {
            $dummies[strtolower($faker->word)] = $faker->name;
        }
        $dummies['booni'] = 'A Rabbit';

        $mem = memory_get_usage();
        $this->imma1 = new ImmAssoc($dummies);
        $this->memory1 = memory_get_peak_usage() - $mem;
    });

    context('calling set()', function () {
        beforeEach(function () {
            $mem = memory_get_usage();
            $this->imma2 = $this->imma1->set('booni', 'A Hare');
            $this->memory2 = memory_get_peak_usage() - $mem;
        });

        it('should has fewer memory', function () {
            assert($this->memory2 < ($this->memory1 / 2), "Clone memory footprint too big: {$this->memory2}");
        });
    });
});
