<?php
    namespace Dubpub\WorkFlow\ViewModel;

    use Dubpub\LaravelUtils\GhostService\GhostService;
    use Dubpub\ViewModel\Interfaces\IFileViewModel;
    use Dubpub\ViewModel\Interfaces\IRequestBag;
    use Dubpub\ViewModel\Interfaces\IViewModel;

    use Input;

    class ViewModelServiceProvider extends GhostService
    {


        /**
         * Get the services provided by the provider.
         *
         * @return array
         */
        public function provides()
        {
            return array('dubpub.viewmodel');
        }

        public function launching()
        {

        }

        public function registering()
        {
            $this->app->bind(
                'Dubpub\ViewModel\Interfaces\IRequestBag',
                'Dubpub\ViewModel\RequestBag'
            );

            $this->app->resolvingAny(function($resolved, $application = null) {
                if ($resolved instanceof IFileViewModel) {
                    foreach($resolved->getAttributeList() as $attribute) {
                        $resolved->{$attribute} = Input::file($attribute);
                    }
                } elseif ($resolved instanceof IRequestBag) {
                    $resolved->fill(Input::all());
                } elseif ($resolved instanceof IViewModel) {
                    $resolved->fill(Input::only($resolved->getAttributeList()));
                }
            });
        }
    }