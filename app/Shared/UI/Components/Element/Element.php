<?php

declare(strict_types=1);

namespace ODE\Shared\UI\Components\Element;

use ODE\Shared\UI\Foundation\Component;
use ODE\Shared\UI\Support\Html;

class Element extends Component
{
    protected string $tag = 'div';

    /**
     * @var array<Component|string>
     */
    protected array $children = [];

    public static function make(string $tag = 'div'): static
    {
        $element = new static();

        $element->tag = $tag;

        return $element;
    }

    public function tag(string $tag): static
    {
        $this->tag = $tag;

        return $this;
    }

    public function child(Component|string $child): static
    {
        $this->children[] = $child;

        return $this;
    }

    /**
     * @param array<Component|string> $children
     */
    public function children(array $children): static
    {
        foreach ($children as $child) {
            $this->child($child);
        }

        return $this;
    }


    protected function renderChildren(): string
    {
        $html = $this->getContent();

        foreach ($this->children as $child) {

            if ($child instanceof Component) {
                $html .= $child->render();
                continue;
            }

            $html .= (string) $child;
        }

        return $html;
    }

    public function render(): string
    {
        if (! $this->isVisible()) {
            return '';
        }

        return Html::tag(
            $this->tag,
            $this->renderChildren(),
            $this->getAttributes()
        );
    }
}