<?php

declare(strict_types=1);

namespace ODE\Shared\UI\Fields;

final class ImageUpload extends Field
{
    protected ?string $preview = null;

    public function preview(?string $preview): static
    {
        $this->preview = $preview;

        return $this;
    }

    public function render(): void
    {
        ?>

        <div class="ode-field">

            <?php if ($this->label !== '') : ?>

                <label
                    class="ode-label"
                    for="<?= esc_attr($this->id); ?>"
                >

                    <?= esc_html($this->label); ?>

                    <?php if ($this->required) : ?>

                        <span class="ode-required">*</span>

                    <?php endif; ?>

                </label>

            <?php endif; ?>

            <div
                class="ode-image-upload"
                data-target="<?= esc_attr($this->id); ?>"
            >

                <input
                    type="hidden"
                    id="<?= esc_attr($this->id); ?>"
                    name="<?= esc_attr($this->name); ?>"
                    value="<?= esc_attr((string) $this->value); ?>"
                >

                <div class="ode-image-preview">

                    <?php if ($this->preview) : ?>

                        <img
                            src="<?= esc_url($this->preview); ?>"
                            alt=""
                        >

                    <?php endif; ?>

                </div>

                <div class="ode-image-actions">

                    <button
                        type="button"
                        class="button ode-media-open"
                    >

                        Selecionar imagem

                    </button>

                    <button
                        type="button"
                        class="button ode-media-remove"
                    >

                        Remover

                    </button>

                </div>

            </div>

            <?php if ($this->help !== null) : ?>

                <p class="description">

                    <?= esc_html($this->help); ?>

                </p>

            <?php endif; ?>

        </div>

        <?php
    }
}