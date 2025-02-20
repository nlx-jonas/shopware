<?php declare(strict_types=1);

namespace Shopware\Core\Migration\V6_6;

use Doctrine\DBAL\Connection;
use Shopware\Core\Content\MailTemplate\MailTemplateTypes;
use Shopware\Core\Framework\Log\Package;
use Shopware\Core\Framework\Migration\MigrationStep;
use Shopware\Core\Migration\Traits\MailUpdate;
use Shopware\Core\Migration\Traits\UpdateMailTrait;

/**
 * @internal
 */
#[Package('core')]
class Migration1701688920FixDownloadLinkMail extends MigrationStep
{
    use UpdateMailTrait;

    public function getCreationTimestamp(): int
    {
        return 1701688920;
    }

    public function update(Connection $connection): void
    {
        $update = new MailUpdate(
            MailTemplateTypes::MAILTYPE_DOWNLOADS_DELIVERY,
            (string) file_get_contents(__DIR__ . '/../Fixtures/mails/downloads_delivery/en-plain.html.twig'),
            (string) file_get_contents(__DIR__ . '/../Fixtures/mails/downloads_delivery/en-html.html.twig'),
            (string) file_get_contents(__DIR__ . '/../Fixtures/mails/downloads_delivery/de-plain.html.twig'),
            (string) file_get_contents(__DIR__ . '/../Fixtures/mails/downloads_delivery/de-html.html.twig')
        );

        $this->updateMail($update, $connection);
    }

    public function updateDestructive(Connection $connection): void
    {
        // implement update destructive
    }
}
