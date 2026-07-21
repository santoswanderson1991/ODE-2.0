<?php

declare(strict_types=1);

use ODE\Shared\UI\Components\Badge\Badge;
use ODE\Shared\UI\Components\ActionGroup\ActionGroup;
use ODE\Shared\UI\Helpers\MoneyFormatter;

?>

<table
    id="ode-product-table"
    class="widefat striped ode-table"
>

    <thead>

    <tr>

        <th width="70">
            Imagem
        </th>

        <th>
            Produto
        </th>

        <th width="180">
            Categoria
        </th>

        <th width="110">
            Preço
        </th>

        <th width="110">
            Promoção
        </th>

        <th width="90">
            Status
        </th>

        <th width="120">
            Ações
        </th>

    </tr>

    </thead>

    <tbody>

    <?php if (empty($products)) : ?>

        <tr>

            <td colspan="7">

                Nenhum produto cadastrado.

            </td>

        </tr>

    <?php else : ?>

        <?php foreach ($products as $product) : ?>

            <tr
                data-id="<?= (int) $product->id; ?>"
            >

                <td>

                    <?php

                    $image = wp_get_attachment_image(
                        (int) $product->image_id,
                        [60,60]
                    );

                    echo $image ?: '—';

                    ?>

                </td>

                <td>

                    <strong>

                        <?= esc_html($product->name); ?>

                    </strong>

                    <br>

                    <small>

                        <?= esc_html($product->slug); ?>

                    </small>

                </td>

                <td>

                    <?= esc_html($product->category_name); ?>

                </td>

                <td>

                    <?= MoneyFormatter::format(
                        (float) $product->price
                    ); ?>

                </td>

                <td>

                    <?php

                    if ($product->sale_price !== null) {

                        echo MoneyFormatter::format(
                            (float) $product->sale_price
                        );

                    } else {

                        echo '—';

                    }

                    ?>

                </td>

                <td>

                    <?php

                    Badge::boolean(
                        (bool) $product->active
                    );

                    ?>

                </td>

                <td>

                    <?php

                    ActionGroup::render(
                        (int) $product->id
                    );

                    ?>

                </td>

            </tr>

        <?php endforeach; ?>

    <?php endif; ?>

    </tbody>

</table>