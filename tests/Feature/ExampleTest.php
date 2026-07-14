<?php

test('home redirects to customers', function () {
    $response = $this->get(route('home'));

    $response->assertRedirect(route('customers.index'));
});
