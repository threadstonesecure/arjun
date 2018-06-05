package com.arjun.qbapp.service;

import org.springframework.beans.factory.annotation.Autowired;

import com.arjun.qbapp.dao.UserDAO;
import com.arjun.qbapp.dao.UserDAOImpl;
import com.arjun.qbapp.entity.UserMaster;

public class UserServiceImpl implements UserService{
	
	@Autowired
	private UserDAO userDAO;

	public UserMaster getUser(int Id) {
		
		
		userDAO = new UserDAOImpl();	
		
		
		return userDAO.getUser(Id);
	}

}
