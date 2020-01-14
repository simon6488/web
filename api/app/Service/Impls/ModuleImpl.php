<?php
declare(strict_types=1);

namespace App\Service\Impls;


use App\Constants\ModuleErrorCode;
use App\Dao\ModuleDao;
use App\Exception\ModuleException;
use App\Request\ModuleRequest;
use App\Service\Interfaces\ModuleImplInterface;
use Hyperf\Di\Annotation\Inject;

class ModuleImpl extends BaseImpl implements ModuleImplInterface
{
    /**
     * @Inject()
     * @var ModuleDao
     */
    private $moduleDao;

    /**
     * @Inject()
     * @var ModuleRequest
     */
    private $moduleRequest;

    public function create(array $data): bool
    {
        $data = $this->moduleRequest->createValidate($data);
        if ($this->moduleDao->findByModulePath($data['module_path'])) {
            throw new ModuleException(ModuleErrorCode::MODULE_PATH_EXIST);
        }
    }

    public function _getModuleTemplate(array $data):array
    {
        return [
            'module_name' => $data['module_name'],
            'module_path' => $data['module_path'],
            'parent_id' => $data['parent_id'] ?? 0,
        ];
    }

    public function update(array $data): bool
    {
        // TODO: Implement update() method.
    }

    public function delete(int $id): array
    {
        // TODO: Implement delete() method.
    }

    public function findOne(int $id): array
    {
        // TODO: Implement findOne() method.
    }
}