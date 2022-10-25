<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Kits\Console\Commands;

use Illuminate\Support\Facades\Config;
use Livewire\Commands\MakeCommand;

class TallLivewireCommand extends MakeCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:tall-livewire  {name} {--force} {--inline} {--test} {--stub=landlord : If you have several stubs, stored in subfolders }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cria componentes livewire na pasta tall';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $this->parser = new ComponentParser(
            'Tall\\Kits\\Http\\Livewire',
            __DIR__.'/../../../resources/views/livewire',
            $this->argument('name'),
            $this->option('stub')
        );

        if (!$this->isClassNameValid($name = $this->parser->className())) {
            $this->line("<options=bold,reverse;fg=red> WHOOPS! </> 😳 \n");
            $this->line("<fg=red;options=bold>Class is invalid:</> {$name}");

            return;
        }

        if ($this->isReservedClassName($name)) {
            $this->line("<options=bold,reverse;fg=red> WHOOPS! </> 😳 \n");
            $this->line("<fg=red;options=bold>Class is reserved:</> {$name}");

            return;
        }

        $force = $this->option('force');
        $inline = $this->option('inline');
        $test = $this->option('test');

        $showWelcomeMessage = $this->isFirstTimeMakingAComponent();

        $class = $this->createClass($force, $inline);
        $view = $this->createView($force, $inline);

        if ($test) {
            $test = $this->createTest($force);
        }

        $this->refreshComponentAutodiscovery();

        if($class || $view) {
            $this->line("<options=bold,reverse;fg=green> COMPONENT CREATED </> 🤙\n");
            $class && $this->line("<options=bold;fg=green>CLASS:</> {$this->parser->relativeClassPath()}");

            if (! $inline) {
                $view && $this->line("<options=bold;fg=green>VIEW:</>  {$this->parser->relativeViewPath()}");
            }

            if ($test) {
                $test && $this->line("<options=bold;fg=green>TEST:</>  {$this->parser->relativeTestPath()}");
            }

            if ($showWelcomeMessage && ! app()->runningUnitTests()) {
                $this->writeWelcomeMessage();
            }
        }
    }
}
