<?php
defined( 'ABSPATH' ) || exit;

if ( $order ) : ?>

    <section class="custom-thankyou-page">

        <h1 class="thankyou-headline">Tak for din bestilling!</h1>
        <p class="thankyou-text">Jeg har modtaget din ordre og glæder mig til at skære smukt træ til dig. Hvis jeg har spørgsmål til din ordre, kontakter jeg dig, inden jeg går igang. </p>

        <hr>

        <h2>Din ordre indeholder:</h2>
        <ul class="custom-order-items">
        <?php
            foreach ( $order->get_items() as $item_id => $item ) :
            $product = $item->get_product();
            if ( ! $product ) {
                continue;
            }
            $product_name = $product->get_name();
            $quantity = $item->get_quantity();
            $total = $item->get_total();
		?>
		<li>
			<?php echo esc_html( $quantity . ' × ' . $product_name ); ?> – <?php echo wc_price( $total ); ?>
		</li>
	<?php endforeach; ?>
</ul>

        <?php if ( $order->has_status( 'failed' ) ) : ?>

            <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed">
                Din betaling mislykkedes. Prøv venligst igen eller kontakt os.
            </p>

        <?php else : ?>

            <ul class="thankyou-order-details">
                <li><strong>Ordrenummer:</strong> <?php echo $order->get_order_number(); ?></li>
                <li><strong>Dato:</strong> <?php echo wc_format_datetime( $order->get_date_created() ); ?></li>
                <li><strong>Total:</strong> <?php echo $order->get_formatted_order_total(); ?></li>
                <li><strong>Betaling:</strong> <?php echo wp_kses_post( $order->get_payment_method_title() ); ?></li>
            </ul>

            <p class="thankyou-confirmation">Du vil modtage en e-mail med ordrebekræftelsen.</p>

            <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="button-tak">Tilbage til shoppen</a>

        <?php endif; ?>

    </section>

<?php else : ?>

    <p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received">
        Tak for din ordre.
    </p>

<?php endif; ?>
