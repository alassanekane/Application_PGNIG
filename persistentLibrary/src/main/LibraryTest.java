package main;

import java.util.ArrayList;
import java.util.GregorianCalendar;

import javax.persistence.EntityManager;
import javax.persistence.EntityTransaction;

import jpaUtils.JPAUtil;
import loansManagement.LoanDAO;

import org.junit.Test;

import subscribersManagement.Entitled;
import subscribersManagement.Subscriber;
import subscribersManagement.SubscriberDAO;
import booksManagement.Book;
import booksManagement.BookDAO;
import exceptions.BadParametersException;
import exceptions.LoanExistsException;

public class LibraryTest {
	private SubscriberDAO subscriberDAO;
	private BookDAO bookDAO;
	private LoanDAO loanDAO;
	
	private ArrayList<String> authors1= new ArrayList<String>();;
	private ArrayList<String> authors2= new ArrayList<String>();;
	
	private void createBooks() throws BadParametersException {
		EntityManager em;
		EntityTransaction tx;		
		bookDAO = new BookDAO();
		
		em= JPAUtil.getEntityManager();
		tx=em.getTransaction();
		tx.begin();
		
		if (bookDAO.isEmpty()) {
			System.out.println("===== Create Book data in memory ====");
			authors1.add("Elmasri");
			authors1.add("Navathe");
			authors2.add("Peter Gulutzan");
			authors2.add("Trudy Pelzer");
			Book b1 = new Book("Fundamentals of Database Systems", authors1, new GregorianCalendar(), "0-321-20228-4");
			Book b2 = new Book("SQL-99 Complete, Really", authors2, new GregorianCalendar(), "0-87930-568-1");
			System.out.println("===== Persist book data ====");
			try {
				bookDAO.add(b1);
				bookDAO.add(b2);
			} catch (Exception pe) {
				System.err.println("Exception when persisting data");
				JPAUtil.closeEntityManager();
				pe.printStackTrace();
			}
		}
		System.out.println("===== Display book data =====");
		System.out.println(bookDAO.toString());

		tx.commit();
		JPAUtil.closeEntityManager();

	}
	private void createSubscribers() throws BadParametersException {
		EntityManager em;
		EntityTransaction tx;		

		em= JPAUtil.getEntityManager();
		tx=em.getTransaction();
		tx.begin();

		subscriberDAO = new SubscriberDAO();
		if (subscriberDAO.isEmpty()) {
			System.out.println("===== Create Subscriber data in memory ====");
			Subscriber 	s1 = new Subscriber("Vincent", "Airo", new GregorianCalendar(1960, 12, 13));
			Subscriber 	s2 = new Subscriber("Betina", "Chtilfiz", new GregorianCalendar(1965, 02, 25));
			Entitled 	s3 = new Entitled("Victor", "Chtilfiz", new GregorianCalendar(1997, 02, 20), s2);
			Entitled 	s4 = new Entitled("Luisa", "Chtilfiz", new GregorianCalendar(1993, 07, 30), s2);
			System.out.println("===== Persist Subscriber data ====");
			try {
				subscriberDAO.add(s1);
				subscriberDAO.add(s2);
				subscriberDAO.add(s3);
				subscriberDAO.add(s4);
			} catch (Exception pe) {
				System.err.println("Exception when persisting data");
				JPAUtil.closeEntityManager();
				pe.printStackTrace();
			}
		}
		System.out.println("===== Display Subscriber data =====");
		System.out.println(subscriberDAO.toString());

		tx.commit();
		JPAUtil.closeEntityManager();
	}
	private void creatLoan() throws LoanExistsException{
		EntityManager em;
		EntityTransaction tx;		
		loanDAO = new LoanDAO();
		
		em= JPAUtil.getEntityManager();
		tx=em.getTransaction();
		tx.begin();
		
		if(loanDAO.isEmpty()){
			System.out.println("===== Create lent data in memory ====");
			
		}
		
	}

	@Test
	public void testAddBook() {
		
	}
	

	/*@Test
	public void testAddSubscriber() {
		fail("Not yet implemented");
	}

	@Test
	public void testDeleteBook() {
		fail("Not yet implemented");
	}

	@Test
	public void testDeleteSubscriber() {
		fail("Not yet implemented");
	}

	@Test
	public void testLend() {
		fail("Not yet implemented");
	}

	@Test
	public void testListBooks() {
		fail("Not yet implemented");
	}

	@Test
	public void testListLoans() {
		fail("Not yet implemented");
	}

	@Test
	public void testListSubscribers() {
		fail("Not yet implemented");
	}

	@Test
	public void testReturnBook() {
		fail("Not yet implemented");
	}
*/
}
