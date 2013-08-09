<?php
return array(
    'campaign' =>
    array(
        'id' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => true,
            'type' => 'integer',
        ),
        'group' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => false,
            'type' => 'related',
        ),
        'name' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => false,
            'type' => 'string',
        ),
        'origin' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => false,
            'type' => 'string',
        ),
        'dateTime' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => true,
            'type' => 'datetime',
        ),
        'isSent' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => true,
            'type' => 'boolean',
        ),
        'dateTimeScheduled' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => false,
            'type' => 'datetime',
        ),
        'message' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => false,
            'type' => 'string',
        ),
        'useStagger' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => false,
            'type' => 'boolean',
        ),
        'staggerBatchSize' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => false,
            'type' => 'integer',
        ),
        'staggerGap' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => false,
            'type' => 'integer',
        ),
        'staggerStartTime' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => false,
            'type' => 'integer',
        ),
        'staggerEndTime' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => false,
            'type' => 'integer',
        ),
        'customId' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => false,
            'type' => 'string',
        ),
    ),
    'contact' =>
    array(
        'id' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => true,
            'type' => 'integer',
        ),
        'displayName' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => false,
            'type' => 'string',
        ),
        'familyName' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => false,
            'type' => 'string',
        ),
        'givenName' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => false,
            'type' => 'string',
        ),
        'msisdn' =>
        (object) array(
            'isNullable' => true,
            'isReadOnly' => false,
            'type' => 'string',
        ),
        'emailAddress' =>
        (object) array(
            'isNullable' => true,
            'isReadOnly' => false,
            'type' => 'string',
        ),
        'group' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => false,
            'type' => 'related',
        ),
    ),
    'dedicated-number' =>
    array(
        'msisdn' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => true,
            'type' => 'string',
        ),
        'type' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => false,
            'type' => 'integer',
        ),
        'httpCallbackUrl' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => false,
            'type' => 'string',
        ),
        'emailCallback' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => false,
            'type' => 'string',
        ),
        'isAutoReplyEnabled' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => false,
            'type' => 'boolean',
        ),
        'autoReplyMessage' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => false,
            'type' => 'string',
        ),
        'autoReplyOrigin' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => false,
            'type' => 'string',
        ),
    ),
    'group' =>
    array(
        'id' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => true,
            'type' => 'integer',
        ),
        'name' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => false,
            'type' => 'string',
        ),
        'keyword' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => false,
            'type' => 'string',
        ),
        'defaultOrigin' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => false,
            'type' => 'string',
        ),
    ),
    'lookup' =>
    array(
        'id' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => true,
            'type' => 'integer',
        ),
        'msisdn' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => false,
            'type' => 'string',
        ),
        'operator' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => true,
            'type' => 'string',
        ),
        'isPorted' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => true,
            'type' => 'boolean',
        ),
        'dateTimeRequested' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => true,
            'type' => 'datetime',
        ),
        'status' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => true,
            'type' => 'integer',
        ),
    ),
    'mms' =>
    array(
        'id' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => true,
            'type' => 'integer',
        ),
        'origin' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => false,
            'type' => 'string',
        ),
        'destination' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => false,
            'type' => 'string',
        ),
        'subject' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => false,
            'type' => 'string',
        ),
        'message' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => false,
            'type' => 'string',
        ),
        'dateTimeSent' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => true,
            'type' => 'datetime',
        ),
        'status' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => true,
            'type' => 'string',
        ),
        'dateTimeStatusUpdate' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => true,
            'type' => 'datetime',
        ),
        'attachments' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => true,
            'type' => 'related',
        ),
    ),
    'mms-attachment' =>
    array(
        'id' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => true,
            'type' => 'integer',
        ),
        'mms' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => true,
            'type' => 'related',
        ),
        'name' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => false,
            'type' => 'string',
        ),
        'type' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => false,
            'type' => 'string',
        ),
        'data' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => false,
            'type' => 'string',
        ),
    ),
    'mms-incoming' =>
    array(
        'id' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => true,
            'type' => 'integer',
        ),
        'origin' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => true,
            'type' => 'string',
        ),
        'destination' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => true,
            'type' => 'string',
        ),
        'subject' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => true,
            'type' => 'string',
        ),
        'message' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => true,
            'type' => 'string',
        ),
        'dateTimeReceived' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => true,
            'type' => 'datetime',
        ),
        'attachments' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => true,
            'type' => 'related',
        ),
    ),
    'mms-incoming-attachment' =>
    array(
        'id' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => true,
            'type' => 'integer',
        ),
        'mms' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => true,
            'type' => 'related',
        ),
        'name' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => false,
            'type' => 'string',
        ),
        'type' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => false,
            'type' => 'string',
        ),
        'data' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => false,
            'type' => 'string',
        ),
    ),
    'shared-pool' =>
    array(
        'id' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => true,
            'type' => 'integer',
        ),
        'name' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => false,
            'type' => 'string',
        ),
        'size' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => true,
            'type' => 'integer',
        ),
    ),
    'sms' =>
    array(
        'id' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => true,
            'type' => 'integer',
        ),
        'origin' =>
        (object) array(
            'isNullable' => true,
            'isReadOnly' => false,
            'type' => 'string',
        ),
        'destination' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => false,
            'type' => 'string',
        ),
        'message' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => false,
            'type' => 'string',
        ),
        'dateTimeCreated' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => true,
            'type' => 'datetime',
        ),
        'campaign' =>
        (object) array(
            'isNullable' => true,
            'isReadOnly' => false,
            'type' => 'related',
        ),
        'sharedPool' =>
        (object) array(
            'isNullable' => true,
            'isReadOnly' => false,
            'type' => 'related',
        ),
    ),
    'sms-incoming' =>
    array(
        'id' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => true,
            'type' => 'integer',
        ),
        'origin' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => true,
            'type' => 'string',
        ),
        'destination' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => true,
            'type' => 'integer',
        ),
        'message' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => true,
            'type' => 'string',
        ),
        'dateTime' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => true,
            'type' => 'datetime',
        ),
        'isConcatenated' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => true,
            'type' => 'boolean',
        ),
        'totalParts' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => true,
            'type' => 'integer',
        ),
        'partNumber' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => true,
            'type' => 'integer',
        ),
    ),
    'sms-scheduled' =>
    array(
        'id' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => true,
            'type' => 'integer',
        ),
        'dateTime' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => false,
            'type' => 'datetime',
        ),
        'origin' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => false,
            'type' => 'string',
        ),
        'destination' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => false,
            'type' => 'string',
        ),
        'message' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => false,
            'type' => 'string',
        ),
    ),
    'template' =>
    array(
        'id' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => true,
            'type' => 'integer',
        ),
        'name' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => false,
            'type' => 'string',
        ),
        'origin' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => false,
            'type' => 'string',
        ),
        'message' =>
        (object) array(
            'isNullable' => false,
            'isReadOnly' => false,
            'type' => 'string',
        ),
    )
);
