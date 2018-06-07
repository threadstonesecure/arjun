package com.arjun.qbapp.service;



import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;

import com.arjun.qbapp.dao.UserDAO;
import com.arjun.qbapp.dao.UserDAOImpl;
import com.arjun.qbapp.entity.UserMaster;

@Service
public class UserServiceImpl implements UserService{
	
	@Autowired
	private UserDAO userDAO;
	@Override
	@Transactional
	public UserMaster getUser(int Id) {
		
		
		//userDAO = new UserDAOImpl();	
		
		
		return userDAO.getUser(Id);
	}

}
