<?php

namespace OpenStack\Volume\v2\Models;

use OpenStack\Common\Resource\AbstractResource;
use OpenStack\Common\Resource\IsListable;
use OpenStack\Common\Resource\IsRetrievable;
use OpenStack\Common\Resource\HasWaiterTrait;

/**
 * Represents a Volume v2 Volume.
 *
 * @property \OpenStack\Volume\v2\Api $api
 */
class Volume extends AbstractResource implements IsListable, IsRetrievable
{
    use HasWaiterTrait;

    public $id;
    public $name;
    public $status;
    public $image;
    public $size;
    public $description;
    public $links;
    public $attachments;
    public $volume_image_metadata;
	public $createdAt;
	public $volumeType;

    protected $resourceKey = 'volume';
    protected $resourcesKey = 'volumes';

	protected $aliases = [
		'created_at'  => 'createdAt',
		'volume_type'  => 'volumeType',
	];

    /**
     * {@inheritDoc}
     */
    public function retrieve()
    {
        $response = $this->execute($this->api->getVolume(), ['id' => (string) $this->id]);
        $this->populateFromResponse($response);
    }

    public function create(array $userOptions)
    {
        $response = $this->execute($this->api->postVolume(), $userOptions);
        return $this->populateFromResponse($response);
    }

	/**
	 * {@inheritDoc}
	 */
	 public function delete()
	 {
	 	$this->execute($this->api->deleteVolume(), $this->getAttrs(['id']));
	 }

}
