<?php

namespace Loo\Html;

use Loo\Helper\ClassHelper;
use Loo\Data\Store;
use Loo\Exception\InvalidTypeException;
use Loo\Exception\NotExistsException;

/**
 * Implements the logic for html forms.
 */
class Form extends AbstractElement
{
    /** @var array */
    private $permittedMethods = ['post', 'get'];
    /** @var FormElementFactory */
    private $elementFactory;
    /** @var Store */
    private $elements;

    /**
     * @param string $id
     */
    public function __construct($id)
    {
        $this->elements = new Store();
        $this->attributes = new Attributes(['id' => $id]);
        $this->elementFactory = new FormElementFactory();
    }

    /**
     * Set method for form. Only methods which are defined in $permittedMethods are allowed.
     *
     * @param string $method
     *
     * @throws InvalidTypeException
     *
     * @return Form
     */
    public function setMethod($method)
    {
        if (in_array(strtolower($method), $this->permittedMethods)) {
            $this->attributes->add(['method' => $method]);
        } else {
            throw new InvalidTypeException('Method type "'.$method.'" is not allowed for forms.');
        }

        return $this;
    }

    /**
     * @param string $action
     *
     * @return Form
     */
    public function setAction($action)
    {
        if ($action !== '') {
            $this->attributes->add(['action' => $action]);
        }

        return $this;
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function get($key)
    {
        return $this->elements->get($key);
    }

    /**
     * @return string
     */
    public function renderOpenTag()
    {
        return '<form'.$this->attributes->render().'>'.PHP_EOL;
    }

    /**
     * @return string
     */
    public function renderCloseTag()
    {
        return  PHP_EOL.'</form>'.PHP_EOL;
    }

    /**
     * @return string
     */
    public function render()
    {
        $os = $this->renderOpenTag();
        $elementIterator = $this->elements->getAll();

        foreach ($elementIterator as $element) {
            $os .= $element;
        }

        $os .= $this->renderCloseTag();

        return $os;
    }

    /**
     * @return FormElementFactory
     */
    public function getElementFactory()
    {
        return $this->elementFactory;
    }

    /**
     * @param array $values
     */
    public function setValues(array $values)
    {
        foreach ($values as $key => $value) {
            $element = $this->elements->get($key);
            $element->setValue($value);
        }
    }

    /**
     * @param array $data
     * @return bool
     * @throws NotExistsException
     */
    public function isSent(array $data)
    {
        $submit = $this->getSubmitElement();

        if (array_key_exists($submit->getId(), $data)) {
            return true;
        }

        return false;
    }

    /**
     * @return string
     * @throws NotExistsException
     */
    public function getId()
    {
        return $this->attributes->get('id');
    }

    /**
     * @param ElementInterface $element
     */
    protected function add(ElementInterface $element)
    {
        $this->elements->set($element->getId(), $element);
    }

    /**
     * @return AbstractHtmlElement
     *
     * @throws NotExistsException
     */
    private function getSubmitElement()
    {
        $elementsIterator = $this->elements->getAll();
        foreach ($elementsIterator as $element) {
            if (ClassHelper::extractClass(get_class($element)) === 'SubmitElement') {
                return $element;
            }
        }

        throw new NotExistsException('The form "'.$this->attributes->get('id').'" has no submit element.');
    }
}
