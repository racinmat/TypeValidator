<?php

namespace Kdyby\Aop_CG\SystemContainer {

use Kdyby\Aop\Pointcut\Matcher\Criteria;
use Symfony\Component\PropertyAccess\PropertyAccess;

final class App_Model_TestedLibraryClass_24_App_Model_TestedLibrary extends \App\Model\TestedLibrary
{

	/**
	 * @var \Nette\DI\Container|\SystemContainer
	 */
	private $_kdyby_aopContainer;

	private $_kdyby_aopAdvices = array();


	/**
	 * @internal
	 * @deprecated
	 */
	public function __publicAopProxy___unset($name)
	{
		return parent::__unset($name);
	}


	/**
	 * Access to undeclared property.
	 * @param  string  property name
	 * @return void
	 * @throws MemberAccessException
	 *
	 */
	public function __unset($name)
	{
		$__arguments = func_get_args(); $__exception = $__result = NULL;
		$this->__getAdvice(22)->validateBefore($__before = new \Kdyby\Aop\JoinPoint\BeforeMethod($this, __FUNCTION__, $__arguments));
		$__arguments = $__before->getArguments();
		try {
			$__result = call_user_func_array("parent::__unset", $__arguments);
		} catch (\Exception $__exception) {
		}
		$this->__getAdvice(22)->validateAfter(new \Kdyby\Aop\JoinPoint\AfterMethod($this, __FUNCTION__, $__arguments, $__result, $__exception));
		if ($__exception) { throw $__exception; }
		return $__result;
	}


	/**
	 * @internal
	 * @deprecated
	 */
	public function __publicAopProxy___isset($name)
	{
		return parent::__isset($name);
	}


	/**
	 * Is property defined?
	 * @param  string  property name
	 * @return bool
	 *
	 */
	public function __isset($name)
	{
		$__arguments = func_get_args(); $__exception = $__result = NULL;
		$this->__getAdvice(22)->validateBefore($__before = new \Kdyby\Aop\JoinPoint\BeforeMethod($this, __FUNCTION__, $__arguments));
		$__arguments = $__before->getArguments();
		try {
			$__result = call_user_func_array("parent::__isset", $__arguments);
		} catch (\Exception $__exception) {
		}
		$this->__getAdvice(22)->validateAfter(new \Kdyby\Aop\JoinPoint\AfterMethod($this, __FUNCTION__, $__arguments, $__result, $__exception));
		if ($__exception) { throw $__exception; }
		return $__result;
	}


	/**
	 * @internal
	 * @deprecated
	 */
	public function __publicAopProxy___set($name, $value)
	{
		return parent::__set($name, $value);
	}


	/**
	 * Sets value of a property. Do not call directly.
	 * @param  string  property name
	 * @param  mixed   property value
	 * @return void
	 * @throws MemberAccessException if the property is not defined or is read-only
	 *
	 */
	public function __set($name, $value)
	{
		$__arguments = func_get_args(); $__exception = $__result = NULL;
		$this->__getAdvice(22)->validateBefore($__before = new \Kdyby\Aop\JoinPoint\BeforeMethod($this, __FUNCTION__, $__arguments));
		$__arguments = $__before->getArguments();
		try {
			$__result = call_user_func_array("parent::__set", $__arguments);
		} catch (\Exception $__exception) {
		}
		$this->__getAdvice(22)->validateAfter(new \Kdyby\Aop\JoinPoint\AfterMethod($this, __FUNCTION__, $__arguments, $__result, $__exception));
		if ($__exception) { throw $__exception; }
		return $__result;
	}


	/**
	 * @internal
	 * @deprecated
	 */
	public function & __publicAopProxy___get($name)
	{
		return parent::__get($name);
	}


	/**
	 * Returns property value. Do not call directly.
	 * @param  string  property name
	 * @return mixed   property value
	 * @throws MemberAccessException if the property is not defined.
	 *
	 */
	public function & __get($name)
	{
		$__arguments = func_get_args(); $__exception = $__result = NULL;
		$this->__getAdvice(22)->validateBefore($__before = new \Kdyby\Aop\JoinPoint\BeforeMethod($this, __FUNCTION__, $__arguments));
		$__arguments = $__before->getArguments();
		try {
			$__result = call_user_func_array("parent::__get", $__arguments);
		} catch (\Exception $__exception) {
		}
		$this->__getAdvice(22)->validateAfter(new \Kdyby\Aop\JoinPoint\AfterMethod($this, __FUNCTION__, $__arguments, $__result, $__exception));
		if ($__exception) { throw $__exception; }
		return $__result;
	}


	/**
	 * @internal
	 * @deprecated
	 */
	public static function __publicAopProxy_extensionMethod($name, $callback = NULL)
	{
		return parent::extensionMethod($name, $callback);
	}


	/**
	 * Adding method to class.
	 * @param  string  method name
	 * @param  callable
	 * @return mixed
	 *
	 */
	public static function extensionMethod($name, $callback = NULL)
	{
		$__arguments = func_get_args(); $__exception = $__result = NULL;
		$this->__getAdvice(22)->validateBefore($__before = new \Kdyby\Aop\JoinPoint\BeforeMethod($this, __FUNCTION__, $__arguments));
		$__arguments = $__before->getArguments();
		try {
			$__result = call_user_func_array("parent::extensionMethod", $__arguments);
		} catch (\Exception $__exception) {
		}
		$this->__getAdvice(22)->validateAfter(new \Kdyby\Aop\JoinPoint\AfterMethod($this, __FUNCTION__, $__arguments, $__result, $__exception));
		if ($__exception) { throw $__exception; }
		return $__result;
	}


	/**
	 * @internal
	 * @deprecated
	 */
	public static function __publicAopProxy___callStatic($name, $args)
	{
		return parent::__callStatic($name, $args);
	}


	/**
	 * Call to undefined static method.
	 * @param  string  method name (in lower case!)
	 * @param  array   arguments
	 * @return mixed
	 * @throws MemberAccessException
	 *
	 */
	public static function __callStatic($name, $args)
	{
		$__arguments = func_get_args(); $__exception = $__result = NULL;
		$this->__getAdvice(22)->validateBefore($__before = new \Kdyby\Aop\JoinPoint\BeforeMethod($this, __FUNCTION__, $__arguments));
		$__arguments = $__before->getArguments();
		try {
			$__result = call_user_func_array("parent::__callStatic", $__arguments);
		} catch (\Exception $__exception) {
		}
		$this->__getAdvice(22)->validateAfter(new \Kdyby\Aop\JoinPoint\AfterMethod($this, __FUNCTION__, $__arguments, $__result, $__exception));
		if ($__exception) { throw $__exception; }
		return $__result;
	}


	/**
	 * @internal
	 * @deprecated
	 */
	public function __publicAopProxy___call($name, $args)
	{
		return parent::__call($name, $args);
	}


	/**
	 * Call to undefined method.
	 * @param  string  method name
	 * @param  array   arguments
	 * @return mixed
	 * @throws MemberAccessException
	 *
	 */
	public function __call($name, $args)
	{
		$__arguments = func_get_args(); $__exception = $__result = NULL;
		$this->__getAdvice(22)->validateBefore($__before = new \Kdyby\Aop\JoinPoint\BeforeMethod($this, __FUNCTION__, $__arguments));
		$__arguments = $__before->getArguments();
		try {
			$__result = call_user_func_array("parent::__call", $__arguments);
		} catch (\Exception $__exception) {
		}
		$this->__getAdvice(22)->validateAfter(new \Kdyby\Aop\JoinPoint\AfterMethod($this, __FUNCTION__, $__arguments, $__result, $__exception));
		if ($__exception) { throw $__exception; }
		return $__result;
	}


	/**
	 * @internal
	 * @deprecated
	 */
	public static function __publicAopProxy_getReflection()
	{
		return parent::getReflection();
	}


	/**
	 * Access to reflection.
	 * @return Nette\Reflection\ClassType|\ReflectionClass
	 *
	 */
	public static function getReflection()
	{
		$__arguments = func_get_args(); $__exception = $__result = NULL;
		$this->__getAdvice(22)->validateBefore($__before = new \Kdyby\Aop\JoinPoint\BeforeMethod($this, __FUNCTION__, $__arguments));
		$__arguments = $__before->getArguments();
		try {
			$__result = call_user_func_array("parent::getReflection", $__arguments);
		} catch (\Exception $__exception) {
		}
		$this->__getAdvice(22)->validateAfter(new \Kdyby\Aop\JoinPoint\AfterMethod($this, __FUNCTION__, $__arguments, $__result, $__exception));
		if ($__exception) { throw $__exception; }
		return $__result;
	}


	/**
	 * @internal
	 * @deprecated
	 */
	public function __publicAopProxy_multiplyWithMissingParametersAnnotation($number1, $number2)
	{
		return parent::multiplyWithMissingParametersAnnotation($number1, $number2);
	}


	/**
	 * @return integer
	 */
	public function multiplyWithMissingParametersAnnotation($number1, $number2)
	{
		$__arguments = func_get_args(); $__exception = $__result = NULL;
		$this->__getAdvice(22)->validateBefore($__before = new \Kdyby\Aop\JoinPoint\BeforeMethod($this, __FUNCTION__, $__arguments));
		$__arguments = $__before->getArguments();
		try {
			$__result = call_user_func_array("parent::multiplyWithMissingParametersAnnotation", $__arguments);
		} catch (\Exception $__exception) {
		}
		$this->__getAdvice(22)->validateAfter(new \Kdyby\Aop\JoinPoint\AfterMethod($this, __FUNCTION__, $__arguments, $__result, $__exception));
		if ($__exception) { throw $__exception; }
		return $__result;
	}


	/**
	 * @internal
	 * @deprecated
	 */
	public function __publicAopProxy_multiplyWithMissingReturnAnnotation($number1, $number2)
	{
		return parent::multiplyWithMissingReturnAnnotation($number1, $number2);
	}


	/**
	 * @param integer $number1
	 * @param integer $number2
	 */
	public function multiplyWithMissingReturnAnnotation($number1, $number2)
	{
		$__arguments = func_get_args(); $__exception = $__result = NULL;
		$this->__getAdvice(22)->validateBefore($__before = new \Kdyby\Aop\JoinPoint\BeforeMethod($this, __FUNCTION__, $__arguments));
		$__arguments = $__before->getArguments();
		try {
			$__result = call_user_func_array("parent::multiplyWithMissingReturnAnnotation", $__arguments);
		} catch (\Exception $__exception) {
		}
		$this->__getAdvice(22)->validateAfter(new \Kdyby\Aop\JoinPoint\AfterMethod($this, __FUNCTION__, $__arguments, $__result, $__exception));
		if ($__exception) { throw $__exception; }
		return $__result;
	}


	/**
	 * @internal
	 * @deprecated
	 */
	public function __publicAopProxy_multiplyWithNoAnnotation($number1, $number2)
	{
		return parent::multiplyWithNoAnnotation($number1, $number2);
	}


	public function multiplyWithNoAnnotation($number1, $number2)
	{
		$__arguments = func_get_args(); $__exception = $__result = NULL;
		$this->__getAdvice(22)->validateBefore($__before = new \Kdyby\Aop\JoinPoint\BeforeMethod($this, __FUNCTION__, $__arguments));
		$__arguments = $__before->getArguments();
		try {
			$__result = call_user_func_array("parent::multiplyWithNoAnnotation", $__arguments);
		} catch (\Exception $__exception) {
		}
		$this->__getAdvice(22)->validateAfter(new \Kdyby\Aop\JoinPoint\AfterMethod($this, __FUNCTION__, $__arguments, $__result, $__exception));
		if ($__exception) { throw $__exception; }
		return $__result;
	}


	/**
	 * @internal
	 * @deprecated
	 */
	public function __publicAopProxy_multiply($number1, $number2)
	{
		return parent::multiply($number1, $number2);
	}


	/**
	 * @param integer $number1
	 * @param integer $number2
	 * @return integer
	 */
	public function multiply($number1, $number2)
	{
		$__arguments = func_get_args(); $__exception = $__result = NULL;
		$this->__getAdvice(22)->validateBefore($__before = new \Kdyby\Aop\JoinPoint\BeforeMethod($this, __FUNCTION__, $__arguments));
		$__arguments = $__before->getArguments();
		try {
			$__result = call_user_func_array("parent::multiply", $__arguments);
		} catch (\Exception $__exception) {
		}
		$this->__getAdvice(22)->validateAfter(new \Kdyby\Aop\JoinPoint\AfterMethod($this, __FUNCTION__, $__arguments, $__result, $__exception));
		if ($__exception) { throw $__exception; }
		return $__result;
	}


	/**
	 * @internal
	 * @deprecated
	 */
	public function __injectAopContainer(\Nette\DI\Container $container)
	{
		$this->_kdyby_aopContainer = $container;
	}


	private function __getAdvice($name)
	{
		if (!isset($this->_kdyby_aopAdvices[$name])) {
			$this->_kdyby_aopAdvices[$name] = $this->_kdyby_aopContainer->createService($name);
		}

		return $this->_kdyby_aopAdvices[$name];
	}


	public function __sleep()
	{
		return array();
	}

}


}

