<?php

namespace Loo\Error;

/**
 * Test the ErrorStack functionality
 */
class ErrorStackTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Adding an error should be added to the stack
     */
    public function testAddError()
    {
        $errorStack = new ErrorStack();

        $errorStack->addError('Foo', 123);
        $errorStack->addError('Bar', 456);

        $this->assertEquals(['Foo', 'Bar'], $errorStack->getTexts());
        $this->assertEquals([123, 456], $errorStack->getCodes());
        $this->assertEquals([new Error('Foo', 123), new Error('Bar', 456)], $errorStack->getErrors());
    }

    /**
     * Test merging of two stacks
     */
    public function testMerge()
    {
        $errorStack1 = new ErrorStack();
        $errorStack1->addError('Foo', 123);
        $errorStack1->addError('Bar', 456);

        $errorStack2 = new ErrorStack();
        $errorStack2->addError('Baz');

        $errorStack1->merge($errorStack2);

        $this->assertEquals(['Foo', 'Bar', 'Baz'], $errorStack1->getTexts());
        $this->assertEquals([123, 456, null], $errorStack1->getCodes());
        $this->assertEquals([new Error('Foo', 123), new Error('Bar', 456), new Error('Baz')], $errorStack1->getErrors());
    }

    /**
     * If there is an error added hasError check should be true
     */
    public function testHasErrorShouldBeTrue()
    {
        $errorStack = new ErrorStack();

        $errorStack->addError('Foo', 123);

        $this->assertTrue($errorStack->hasErrors());
    }

    /**
     * If there is no error added hasError check should be false
     */
    public function testHasErrorShouldBeFalse()
    {
        $errorStack = new ErrorStack();

        $this->assertFalse($errorStack->hasErrors());
    }

    /**
     * Calling json_encode on the error stack should return a array with objects containing the message and the error code
     */
    public function testJson()
    {
        $errorStack = new ErrorStack();

        $errorStack->addError('Foo', 123);
        $errorStack->addError('Bar', 456);

        $this->assertEquals('[{"message":"Foo","code":123},{"message":"Bar","code":456}]', json_encode($errorStack));
    }
}
