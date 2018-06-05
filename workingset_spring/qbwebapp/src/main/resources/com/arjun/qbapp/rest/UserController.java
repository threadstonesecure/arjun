package com.arjun.qbapp.rest;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import com.arjun.qbapp.entity.UserMaster;
import com.arjun.qbapp.service.UserService;
import com.arjun.qbapp.service.UserServiceImpl;

@RestController
@RequestMapping("/api")
public class UserController {
	
	@Autowired
	private UserService userService;
	
	@GetMapping("/user/{userId}")
	public UserMaster getUser(@PathVariable int userId) {
		
		
		
		return userService.getUser(userId);
	}

}
