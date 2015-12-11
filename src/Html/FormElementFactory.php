<?php

namespace Loo\Html;

use Loo\Core\FactoryInterface;

/**
 * Creates all elements which are needed by html forms.
 */
class FormElementFactory implements FactoryInterface
{
    /**
     * @param string $id
     * @param string $label
     * @param array  $htmlAttributes
     * @return ElementContainer
     */
    public function getInputText($id, $label, array $htmlAttributes = [])
    {
        return $this->getElementWithLabel(new TextElement($id, $htmlAttributes), $label);
    }

    /**
     * @param string $id
     * @param string $label
     * @param array  $htmlAttributes
     * @return ElementContainer
     */
    public function getInputPassword($id, $label, array $htmlAttributes = [])
    {
        $element = new PasswordElement($id, $htmlAttributes);
        $element->setOblivious(true);

        return $this->getElementWithLabel($element, $label);
    }

    /**
     * @param string $group
     * @param array  $members
     * @param array  $htmlAttributes
     * @return ElementContainer
     */
    public function getInputRadio($group, array $members, array $htmlAttributes = [])
    {
        $container = new ElementContainer($group);

        foreach ($members as $label => $value) {
            $id = $group.'_'.$value;

            $container->add(
                $this->getElementWithLabel(new RadioElement($id, $group, $value, $htmlAttributes), $label),
                $id
            );
        }

        return $container;
    }

    /**
     * @param string $group
     * @param array  $members
     * @param array  $htmlAttributes
     * @return ElementContainer
     */
    public function getInputCheckbox($group, array $members, array $htmlAttributes = [])
    {
        $container = new ElementContainer($group);

        foreach ($members as $label => $value) {
            $id = $group.'_'.$value;

            $container->add(
                $this->getElementWithLabel(new CheckboxElement($id, $group, $value, $htmlAttributes), $label),
                $id
            );
        }

        return $container;
    }

    /**
     * @param string $id
     * @param string $title
     * @param array  $htmlAttributes
     * @return SubmitElement
     */
    public function getSubmit($id, $title, array $htmlAttributes = [])
    {
        return new SubmitElement($id, $title, $htmlAttributes);
    }

    /**
     * @param string $id
     * @param string $label
     * @param array  $htmlAttributes
     * @return ElementContainer
     */
    public function getTextarea($id, $label, array $htmlAttributes = [])
    {
        return $this->getElementWithLabel(new TextareaElement($id, $htmlAttributes), $label);
    }

    /**
     * @param string $id
     * @param string $value
     * @param array  $htmlAttributes
     * @return AbstractHtmlElement
     */
    public function getHiddenInput($id, $value, array $htmlAttributes = [])
    {
        $element = new HiddenElementInput($id, $htmlAttributes);

        return $element->setValue($value);
    }

    /**
     * @param string $id
     * @param string $text
     * @param string $forId
     * @return LabelElement
     */
    public function getLabel($id, $text, $forId = '')
    {
        return new LabelElement($id, $text, $forId);
    }

    /**
     * @param AbstractHtmlElement $element
     * @param string $label
     * @param bool $preLabel
     * @return ElementContainer
     */
    private function getElementWithLabel(AbstractHtmlElement $element, $label, $preLabel = true)
    {
        $container = new ElementContainer($element->getId());
        $label = $this->getLabel('label_'.$element->getId(), $label, $element->getId());

        if ($preLabel) {
            $container->add($label, 'label');
        }
        $container->add($element, 'control');
        if (!$preLabel) {
            $container->add($label, 'label');
        }

        return $container;
    }
}
