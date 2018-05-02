<?php

/**
 * @file
 * Contains \Eloqua\Api\Assets\Form.
 */

namespace Eloqua\Api\Assets;

use Eloqua\Api\AbstractApi;
use Eloqua\Api\CreatableInterface;
use Eloqua\Api\DestroyableInterface;
use Eloqua\Api\ReadableInterface;
use Eloqua\Api\SearchableInterface;
use Eloqua\Api\UpdateableInterface;

/**
 * Eloqua Form.
 */
class Form extends AbstractApi implements SearchableInterface, CreatableInterface, ReadableInterface, DestroyableInterface, UpdateableInterface {

  /**
   * {@inheritdoc}
   */
  public function search($search, array $options = array()) {
    return $this->get('assets/forms', array_merge(array(
      'search' => $search,
    ), $options));
  }

  /**
   * {@inheritdoc}
   */
  public function create($data) {
    return $this->post('assets/form', $data);
  }

  /**
   * {@inheritdoc}
   */
  public function show($id, $depth = 'complete', $extensions = null) {
    return $this->get('assets/form/' . rawurlencode($id), array(
      'depth' => $depth,
    ));
  }

  /**
   * {@inheritdoc}
   */
  public function update($id, $data) {
    return $this->put('assets/form/' . rawurlencode($id), $data);
  }

  /**
   * {@inheritdoc}
   */
  public function remove($id) {
    return $this->delete('assets/form/' . rawurlencode($id));
  }

}
