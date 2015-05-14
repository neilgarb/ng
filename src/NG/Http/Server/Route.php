<?php

namespace NG\Http\Server;

class Route {
    /**
     * @var string
     */
    protected $path;

    /**
     * @var AbstractHandler
     */
    protected $handler;

    /**
     * @var array
     */
    protected $methods;

    /**
     * @param $path
     * @param $handler
     */
    public function __construct($path, AbstractHandler $handler) {
        $this->path = $path;
        $this->handler = $handler;
    }

    /**
     * @return AbstractHandler
     */
    public function getHandler() {
        return $this->handler;
    }

    /**
     * @param Request $request
     * @return RouteMatch
     */
    public function match(Request $request) {
        $matches = [];
        $res = preg_match(
            '#^' . $this->path . '$#',
            $request->getRequestPath(),
            $matches
        );
        if ($res) {
            return new RouteMatch($request, $this, $matches);
        } else {
            return null;
        }
    }
}
