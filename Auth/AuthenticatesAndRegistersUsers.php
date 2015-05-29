<?php namespace Xtwoend\Component\User\Auth;

trait AuthenticatesAndRegistersUsers {

	use AuthenticatesUsers, RegistersUsers {
		AuthenticatesUsers::redirectPath insteadof RegistersUsers;
	}

}
