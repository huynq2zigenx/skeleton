<?php
use App\Http\Controllers\Apply\HomeController;
use Domain\Apply\ViewModels\RecruitViewModels;
use Illuminate\Http\Request;
use Inertia\Response;

beforeEach(function () {
    // Mock the Request object
    $this->request = Mockery::mock(Request::class);
    $this->request->shouldReceive('get')
        ->with('page', 1)
        ->andReturn(1);
    $this->request->shouldReceive('all')
        ->andReturn(['some' => 'data']);
    $this->request->shouldReceive('getQueryString')
        ->andReturn('some=query');

    // Mock the RecruitViewModels object
    $this->recruitViewModel = Mockery::mock(RecruitViewModels::class, [1, route('home'), ['some' => 'data']]);

    // Bind the mock to the container
    $this->app->instance(RecruitViewModels::class, $this->recruitViewModel);

    // Create the controller instance
    $this->controller = new HomeController();
});

test('HomeController index method returns instance of Inertia\Response', function () {
    $response = $this->controller->index($this->request);
    expect($response)->toBeInstanceOf(Response::class);
});

test('HomeController index method sets correct component name', function () {
    $response = $this->controller->index($this->request);

    // Use reflection to access protected properties
    $reflection = new ReflectionClass($response);

    $componentProperty = $reflection->getProperty('component');
    $componentProperty->setAccessible(true);
    $component = $componentProperty->getValue($response);

    expect($component)->toBe('Home/Index');
});

test('HomeController index method sets correct query prop', function () {
    $response = $this->controller->index($this->request);

    // Use reflection to access protected properties
    $reflection = new ReflectionClass($response);

    $propsProperty = $reflection->getProperty('props');
    $propsProperty->setAccessible(true);
    $props = $propsProperty->getValue($response);

    expect($props['query'])->toBe('some=query');
});

test('HomeController index method sets correct model prop with expected properties', function () {
    $response = $this->controller->index($this->request);

    // Use reflection to access protected properties
    $reflection = new ReflectionClass($response);

    $propsProperty = $reflection->getProperty('props');
    $propsProperty->setAccessible(true);
    $props = $propsProperty->getValue($response);

    // Assert that the 'model' prop is an instance of RecruitViewModels
    expect($props['model'])->toBeInstanceOf(RecruitViewModels::class);

    // Use reflection to access private properties of RecruitViewModels
    $modelReflection = new ReflectionClass($props['model']);

    $currentPageProperty = $modelReflection->getProperty('currentPage');
    $currentPageProperty->setAccessible(true);
    $currentPage = $currentPageProperty->getValue($props['model']);

    $pathProperty = $modelReflection->getProperty('path');
    $pathProperty->setAccessible(true);
    $path = $pathProperty->getValue($props['model']);

    $queryProperty = $modelReflection->getProperty('query');
    $queryProperty->setAccessible(true);
    $query = $queryProperty->getValue($props['model']);

    // Assert that the private properties of RecruitViewModels are correct
    expect($currentPage)->toBe(1);
    expect($path)->toBe(route('home'));
    expect($query)->toBe(['some' => 'data']);
});

// Clean up Mockery
afterEach(function () {
    Mockery::close();
});
