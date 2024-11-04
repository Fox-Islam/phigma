<?php

namespace Phox\Phigma\Strings;

class AccessTokenScopes
{
    public const string FILES_READ = 'files:read';
    public const string FILE_VARIABLES_READ = 'file_variables:read';
    public const string FILE_VARIABLES_WRITE = 'file_variables:write';
    public const string FILE_COMMENTS_WRITE = 'file_comments:write';
    public const string FILE_DEV_RESOURCES_READ = 'file_dev_resources:read';
    public const string FILE_DEV_RESOURCES_WRITE = 'file_dev_resources:write';
    public const string LIBRARY_ANALYTICS_READ = 'library_analytics:read';
    public const string WEBHOOKS_WRITE = 'webhooks:write';
}
