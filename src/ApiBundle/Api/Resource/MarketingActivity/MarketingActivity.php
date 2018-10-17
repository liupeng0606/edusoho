<?php

namespace ApiBundle\Api\Resource\MarketingActivity;

use ApiBundle\Api\Annotation\Access;
use ApiBundle\Api\ApiRequest;
use ApiBundle\Api\Resource\AbstractResource;
use AppBundle\Common\ArrayToolkit;
use Codeages\RestApiClient\RestApiClient;
use Codeages\RestApiClient\Specification\JsonHmacSpecification2;

class MarketingActivity extends AbstractResource
{
    /**
     * @param ApiRequest $request
     *
     * @return mixed
     * @Access(roles="ROLE_ADMIN,ROLE_SUPER_ADMIN")
     */
    public function search(ApiRequest $request)
    {
        list($offset, $limit) = $this->getOffsetAndLimit($request);
        //搜索条件：学校id,type,name,status,itemType
        $user = $this->getCurrentUser();

        $client = $this->createMarketingClient();
        $entry = $request->query->get('entry');
        $activities = $client->get('/activities?merchant_user_id='.$user['id'], array());

        exit();

        $activityGroups = ArrayToolkit::group($activities, 'itemType');
        $activities = array();
        foreach ($activityGroups as $key => &$groups) {
            $this->getOCUtil()->multiple($groups, array('itemId'), $key);
            $activities = array_merge($activities, $groups);
        }

        $total = 33;

        return $this->makePagingObject($activities, $total, $offset, $limit);
    }

    private function createMarketingClient()
    {
        $storage = $this->getSettingService()->get('storage', array());
        $developerSetting = $this->getSettingService()->get('developer', array());

        $marketingDomain = !empty($developerSetting['marketing_domain']) ? $developerSetting['marketing_domain'] : 'http://wyx.edusoho.cn';

        $config = array(
            'accessKey' => $storage['cloud_access_key'],
            'secretKey' => $storage['cloud_secret_key'],
            'endpoint' => $marketingDomain.'/merchant',
        );
        $spec = new JsonHmacSpecification2('sha1');
        $client = new RestApiClient($config, $spec);

        return $client;
    }

    private function getSettingService()
    {
        return $this->service('System:SettingService');
    }
}
