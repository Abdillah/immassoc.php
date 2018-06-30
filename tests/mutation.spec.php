<?php

describe('ImmAssoc', function () {
    beforeEach(function () {
        // use the factory to create a Faker\Generator instance
        $faker = Faker\Factory::create();
        $dummies = [];
        for ($i=0; $i < 100000; $i++) {
            $dummies[strtolower($faker->word)] = $faker->name;
        }
        $dummies['booni'] = 'A Rabbit';

        $this->imma1 = new ImmAssoc($dummies);
    });

    context('calling set()', function () {
        beforeEach(function () {
            $this->imma2 = $this->imma1->set('booni', 'A Hare');
        });

        it('should copy', function () {
            assert($this->imma2['booni'] !== $this->imma1['booni']);
        });
    });
});
