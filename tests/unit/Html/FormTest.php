<?php

namespace Loo\Html;

use Loo\Exception\InvalidTypeException;
use Loo\Http\Request;
use PHPUnit_Framework_TestCase;
use ReflectionClass;

/**
 * Test if Html form works like it should
 */
class FormTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test if form gets rendered.
     */
    public function testFormRender()
    {
        $form = new Form('test', new FormElementFactory());

        $stub = $this->getMockForAbstractClass(AbstractHtmlElement::class, ['type']);
        $stub->expects($this->any())
            ->method('getAttribute')
            ->will($this->returnValue('id1'));
        $stub->expects($this->any())
            ->method('render')
            ->will($this->returnValue('id1_render'));

        $class = new ReflectionClass(Form::class);
        $method = $class->getMethod('add');
        $method->setAccessible(true);
        $method->invokeArgs($form, [$stub]);

        $this->assertSame("<form id=\"test\">".PHP_EOL."id1_render".PHP_EOL."</form>".PHP_EOL, $form->render());
    }

    /**
     * Setting method.
     *
     * @throws InvalidTypeException
     */
    public function testSetValidMethod()
    {
        $form = new Form('test', new FormElementFactory());

        $form->setMethod('get');

        $this->assertSame("<form id=\"test\" method=\"get\">".PHP_EOL.PHP_EOL."</form>".PHP_EOL, $form->render());
    }

    /**
     * Test if exception is thrown is not allowed method is set.
     *
     * @throws InvalidTypeException
     */
    public function testSetInvalidMethod()
    {
        $form = new Form('test', new FormElementFactory());
        $this->setExpectedException(InvalidTypeException::class);

        $form->setMethod('foo');

        $this->assertSame("<form id=\"test\" method=\"foo\"'></form>".PHP_EOL, $form->render());
    }

    /**
     * Test if setting an action gets rendered.
     */
    public function testSetAction()
    {
        $form = new Form('test', new FormElementFactory());

        $form->setAction('index.php');

        $this->assertSame("<form id=\"test\" action=\"index.php\">".PHP_EOL.PHP_EOL."</form>".PHP_EOL, $form->render());
    }

    /**
     * Test if form has sent
     */
    public function testIsSent()
    {
        $form = new Form('test', new FormElementFactory());

        $element = new SubmitElement('submit', 'submit');

        $stub = $this->getMock(Request::class, [], ['']);
        $stub->expects($this->any())
            ->method('getData')
            ->will($this->returnValue(['submit' => 'submit']));

        $class = new ReflectionClass(Form::class);
        $method = $class->getMethod('add');
        $method->setAccessible(true);
        $method->invokeArgs($form, [$element]);

        /** @var Request $stub */
        $this->assertTrue($form->isSent($stub->getData()));
    }
}
