<?php

namespace SIGA\Authentication\Acl;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Permissions\Acl\AclInterface;

class Guard {

    /**
     * @param  Array $acl The preconfigured ACL service
     */
    public function __construct(AclInterface $acl, $currentUserRole) {
        $this->acl = $acl;
        $this->currentUserRole = $currentUserRole;
    }

    /**
     * Invoke middleware
     *
     * @param  RequestInterface  $request  PSR7 request object
     * @param  ResponseInterface $response PSR7 response object
     * @param  callable          $next     Next middleware callable
     *
     * @return ResponseInterface PSR7 response object
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response, callable $next) {
        $isAllowed = false;

        if ($this->acl->hasResource(sprintf('route%s', $request->getAttribute('route')->getPattern()))) {
            $isAllowed = $isAllowed || $this->acl->isAllowed($this->currentUserRole, sprintf('route%s', $request->getAttribute('route')->getPattern()), strtolower($request->getMethod()));
        }
        var_dump(sprintf('route%s', $request->getAttribute('route')->getPattern()));
        if ($this->acl->hasResource(sprintf('callable/%s', $request->getAttribute('route')->getCallable()))) {
            $isAllowed = $isAllowed || $this->acl->isAllowed($this->currentUserRole, sprintf('callable/%s', $request->getAttribute('route')->getCallable()));
        }
        var_dump(sprintf('callable/%s', $request->getAttribute('route')->getCallable()));
        if (!$isAllowed) {
           return $response->withStatus(403, sprintf(' %s is not allowed access to this location.', $this->currentUserRole));
            // return $response->withStatus(403, $this->currentUserRole . ' is not allowed access to this location.');
        }
        return $next($request, $response);
    }

}
