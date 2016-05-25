<?php

/**
 * Print formatted post date.
 */
function motor_the_date() {
	printf(
		'<a href="%s" class="post-info__item date">%s</a>',
		esc_url( get_permalink() ),
		get_the_date()
	);
}
