<?php
use Peridot\Leo\Interfaces\Assert;

describe('Trie', function () {
    beforeEach(function () {
        $this->assert = new Assert();
        $this->trie = new Trie();
    });

    context('non-existing value queried', function () {
        it('should return null', function () {
            $this->assert->equal($this->trie->get('unexist'), null);
        });
    });

    context('one letter path value added', function () {
        beforeEach(function () {
            $this->trie->add('h', 'HELLO');
        });

        it('should be accessible', function () {
            $this->assert->equal($this->trie->get('h'), 'HELLO');
        });

        context('non-existing value queried', function () {
            it('should return null', function () {
                $this->assert->equal($this->trie->get('he'), null);
            });
        });
    });

    context('long path value added', function () {
        beforeEach(function () {
            $this->trie->add('hello', 'HELLO');
        });

        it('should be accessible', function () {
            $this->assert->equal($this->trie->get('hello'), 'HELLO');
        });

        it('should return null on incomplete path', function () {
            $this->assert->equal($this->trie->get('he'), null);
        });

        context('non-existing value queried', function () {
            it('should return null', function () {
                $this->assert->equal($this->trie->get('herna'), null);
            });
        });
    });

    context('value removed', function () {
        beforeEach(function () {
            $this->trie->add('hello', 'HELLO');
            $this->trie->remove('hello');
        });

        it('should be inaccessible', function () {
            $this->assert->equal($this->trie->get('hello'), null);
        });

        it('should be purged the path', function () {
            $this->assert->equal($this->trie->get('he'), null);
        });
    });
});
