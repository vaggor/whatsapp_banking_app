<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\FlexApi\V1;

use Twilio\Exceptions\TwilioException;
use Twilio\ListResource;
use Twilio\Options;
use Twilio\Values;
use Twilio\Version;

class WebChannelList extends ListResource {
    /**
     * Construct the WebChannelList
     *
     * @param Version $version Version that contains the resource
     * @return \Twilio\Rest\FlexApi\V1\WebChannelList
     */
    public function __construct(Version $version) {
        parent::__construct($version);

        // Path Solution
        $this->solution = array();

        $this->uri = '/WebChannels';
    }

    /**
     * Streams WebChannelInstance records from the API as a generator stream.
     * This operation lazily loads records as efficiently as possible until the
     * limit
     * is reached.
     * The results are returned as a generator, so this operation is memory
     * efficient.
     *
     * @param int $limit Upper limit for the number of records to return. stream()
     *                   guarantees to never return more than limit.  Default is no
     *                   limit
     * @param mixed $pageSize Number of records to fetch per request, when not set
     *                        will use the default value of 50 records.  If no
     *                        page_size is defined but a limit is defined, stream()
     *                        will attempt to read the limit with the most
     *                        efficient page size, i.e. min(limit, 1000)
     * @return \Twilio\Stream stream of results
     */
    public function stream($limit = null, $pageSize = null) {
        $limits = $this->version->readLimits($limit, $pageSize);

        $page = $this->page($limits['pageSize']);

        return $this->version->stream($page, $limits['limit'], $limits['pageLimit']);
    }

    /**
     * Reads WebChannelInstance records from the API as a list.
     * Unlike stream(), this operation is eager and will load `limit` records into
     * memory before returning.
     *
     * @param int $limit Upper limit for the number of records to return. read()
     *                   guarantees to never return more than limit.  Default is no
     *                   limit
     * @param mixed $pageSize Number of records to fetch per request, when not set
     *                        will use the default value of 50 records.  If no
     *                        page_size is defined but a limit is defined, read()
     *                        will attempt to read the limit with the most
     *                        efficient page size, i.e. min(limit, 1000)
     * @return WebChannelInstance[] Array of results
     */
    public function read($limit = null, $pageSize = null) {
        return iterator_to_array($this->stream($limit, $pageSize), false);
    }

    /**
     * Retrieve a single page of WebChannelInstance records from the API.
     * Request is executed immediately
     *
     * @param mixed $pageSize Number of records to return, defaults to 50
     * @param string $pageToken PageToken provided by the API
     * @param mixed $pageNumber Page Number, this value is simply for client state
     * @return \Twilio\Page Page of WebChannelInstance
     */
    public function page($pageSize = Values::NONE, $pageToken = Values::NONE, $pageNumber = Values::NONE) {
        $params = Values::of(array(
            'PageToken' => $pageToken,
            'Page' => $pageNumber,
            'PageSize' => $pageSize,
        ));

        $response = $this->version->page(
            'GET',
            $this->uri,
            $params
        );

        return new WebChannelPage($this->version, $response, $this->solution);
    }

    /**
     * Retrieve a specific page of WebChannelInstance records from the API.
     * Request is executed immediately
     *
     * @param string $targetUrl API-generated URL for the requested results page
     * @return \Twilio\Page Page of WebChannelInstance
     */
    public function getPage($targetUrl) {
        $response = $this->version->getDomain()->getClient()->request(
            'GET',
            $targetUrl
        );

        return new WebChannelPage($this->version, $response, $this->solution);
    }

    /**
     * Create a new WebChannelInstance
     *
     * @param string $flexFlowSid The unique ID of the FlexFlow
     * @param string $identity Chat identity
     * @param string $customerFriendlyName Customer friendly name
     * @param string $chatFriendlyName Chat channel friendly name
     * @param array|Options $options Optional Arguments
     * @return WebChannelInstance Newly created WebChannelInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function create($flexFlowSid, $identity, $customerFriendlyName, $chatFriendlyName, $options = array()) {
        $options = new Values($options);

        $data = Values::of(array(
            'FlexFlowSid' => $flexFlowSid,
            'Identity' => $identity,
            'CustomerFriendlyName' => $customerFriendlyName,
            'ChatFriendlyName' => $chatFriendlyName,
            'ChatUniqueName' => $options['chatUniqueName'],
            'PreEngagementData' => $options['preEngagementData'],
        ));

        $payload = $this->version->create(
            'POST',
            $this->uri,
            array(),
            $data
        );

        return new WebChannelInstance($this->version, $payload);
    }

    /**
     * Constructs a WebChannelContext
     *
     * @param string $sid Flex Chat Channel Sid
     * @return \Twilio\Rest\FlexApi\V1\WebChannelContext
     */
    public function getContext($sid) {
        return new WebChannelContext($this->version, $sid);
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString() {
        return '[Twilio.FlexApi.V1.WebChannelList]';
    }
}