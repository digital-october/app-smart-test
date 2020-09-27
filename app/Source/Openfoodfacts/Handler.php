<?php


namespace App\Source\Openfoodfacts;


final class Handler
{
    private \stdClass $response;

    /**
     * Handler constructor.
     *
     * @param string $response
     */
    public function __construct(string $response)
    {
        $this->response = json_decode($response);
    }

    /**
     * Returns the final content.
     *
     * @return mixed
     */
    public function getContents()
    {
        $data = $this->response;

        // hardcode pagination.
        $data->page = (int)$data->page;
        $data->start = ($data->page > 2) ? $data->page - 2 : 1;
        $data->end = ($data->page > 2) ? $data->page + 3 : 5;

        $data->products = $this->prepareProducts();

        return get_object_vars($data);
    }

    /**
     * Prepares data for the front.
     *
     * @return array
     */
    private function prepareProducts(): array
    {
        if (empty($this->response->products)) {
            return [];
        }

        $products = [];
        foreach ($this->response->products as $product) {
            $products[] = [
                'product_name' => $product->product_name,
                'categories' => $product->categories ?? null,
                'image_url' => $product->image_url ?? null,
                '_id' => $product->_id,
                'saved' => false,
            ];
        }

        return $products;
    }
}
