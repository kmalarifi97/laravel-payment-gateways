<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class MakePaymentGateway extends Command
{
    protected $signature = 'make:payment-gateway {name}';
    protected $description = 'Generate a payment gateway class in app/PaymentGateways';

    public function handle()
    {
        $name = Str::studly($this->argument('name'));
        $dir = app_path('PaymentGateways');
        $path = $dir . '/' . $name . '.php';

        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        if (file_exists($path)) {
            $this->error('File already exists: ' . $path);
            return;
        }

        $namespace = 'App\\PaymentGateways';
        $contract = 'Kmalarifi\\PaymentGateways\\Contracts\\PaymentGatewayContract';
        $abstract = 'Kmalarifi\\PaymentGateways\\AbstractGateway';

        $stub = <<<EOT
<?php

namespace $namespace;

use $contract;
use $abstract;

class $name extends AbstractGateway implements PaymentGatewayContract
{
    public function createCheckout(
        float \$amount,
        string \$currency,
        string \$paymentMethod,
        string \$customerGivenName,
        string \$customerSurname,
        string \$customerIdDocType,
        string \$customerIdDocId,
        string \$accessToken,
        int|string \$customerId,
        string \$merchantTransactionId,
    ) {
        // TODO: Implement createCheckout() logic for $name
        throw new \\Exception('Not implemented');
    }
}
EOT;

        file_put_contents($path, $stub);
        $this->info("Gateway created: $path");
    }
}
