<?php

namespace OpenStack\Volume\v2\Models;

use OpenStack\Common\Resource\AbstractResource;
use OpenStack\Common\Resource\IsListable;
use OpenStack\Common\Resource\IsRetrievable;

/**
 * Represents a Volume v2 Volume.
 *
 * @property \OpenStack\Volume\v2\Api $api
 */
class Backup extends AbstractResource implements IsListable, IsRetrievable
{
    public $id;
    public $name;
    public $status;
    public $size;
	public $createdAt;

    protected $resourceKey = 'backup';
    protected $resourcesKey = 'backups';

	protected $aliases = [
		'created_at'  => 'createdAt',
	];

    /**
     * {@inheritDoc}
     */
    public function retrieve()
    {
        $response = $this->execute($this->api->getBackup(), ['id' => (string) $this->id]);
        $this->populateFromResponse($response);
    }

    public function create(array $userOptions)
    {
        $response = $this->execute($this->api->postBackup(), $userOptions);
        return $this->populateFromResponse($response);
    }

    /**
     * {@inheritDoc}
     */
     public function delete()
     {
        $this->execute($this->api->deleteBackup(), $this->getAttrs(['id']));
     }

}
