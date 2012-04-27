/**
 * 
 */
package tests;

import static org.junit.Assert.*;

import javax.persistence.*;
import jpaUtils.*;

import java.util.*;

import org.hibernate.LazyInitializationException;
import org.junit.*;


import booksManagement.*;
import subscribersManagement.*;
import loansManagement.*;

import exceptions.*;

/**
 * @author user
 *
 */
public class PersistentLibraryTest {
	private SubscriberDAO subscriberDAO;
	private BookDAO bookDAO;
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


	@Before
	public void beforeTests() throws BadParametersException {
		createSubscribers();
		createBooks();
	}

	@Test
	public void testNoTATestButStoresData() {
		System.out.println("***************Store data***************");
	}

	@Test
	public void testDetachedData1() throws SubscriberExistsException {
		long sNumber=3;

		EntityManager em= JPAUtil.getEntityManager();
		EntityTransaction tx=em.getTransaction();
		tx.begin();
		Subscriber s= subscriberDAO.get(sNumber);
		Entitled e=(Entitled)s;

		tx.commit();
		JPAUtil.closeEntityManager();

		System.out.println("\n Subscriber number "+ sNumber +" is "+s);

	}

	@Test(expected=LazyInitializationException.class)
	public void testDetachedData2() throws SubscriberExistsException {

		long sNumber=3;

		EntityManager em= JPAUtil.getEntityManager();
		EntityTransaction tx=em.getTransaction();
		tx.begin();

		Subscriber s= subscriberDAO.get(sNumber);
		Entitled e=(Entitled)s;

		tx.commit();
		JPAUtil.closeEntityManager();
		

		System.out.println("\n Subscriber number "+ sNumber +" is "+e);

		List<Entitled> entitles = e.getMainSubscriber().getEntitles();

		if (entitles == null) 
			System.out.println("\n No entitles for " + e.getMainSubscriber());
		else
			System.out.println("\n Entitles of "+ e.getMainSubscriber() +" are "+ entitles);
	}

	
	@Test
	public void testUpdateSimpleTypedValue1() throws SubscriberExistsException {

		EntityManager em = JPAUtil.getEntityManager();
		EntityTransaction tx= em.getTransaction();
		tx.begin();

		Subscriber subscriber = subscriberDAO.GetSingleSubscriberByLastName("Airo");
		System.out.println("Subscriber.firstName=" + subscriber.getFirstName());
		tx.commit();
		JPAUtil.closeEntityManager();

		subscriber.setFirstName("my new firstname");
		
		em = JPAUtil.getEntityManager();
		tx = em.getTransaction();
		tx.begin();

		em.merge(subscriber);
		       
		subscriber = subscriberDAO.GetSingleSubscriberByLastName("Airo");
		System.out.println("Subscriber.firstname=" + subscriber.getFirstName());

		tx.commit();
		JPAUtil.closeEntityManager();
	}
	
	
	@Test
	public void testUpdateSimpleTypedValue2() throws SubscriberExistsException {

		EntityManager em = JPAUtil.getEntityManager();
		EntityTransaction tx= em.getTransaction();
		tx.begin();

		Subscriber subscriber = subscriberDAO.GetSingleSubscriberByLastName("Airo");
		System.out.println("Before update \n Subscriber variable firstName=" + subscriber.getFirstName());
		tx.commit();
		JPAUtil.closeEntityManager();

		Subscriber pers = new Subscriber();
		pers.setNumber(subscriber.getNumber());
		pers.setLastName(subscriber.getLastName());
		pers.setFirstName("my new firstname");
		
		em = JPAUtil.getEntityManager();
		tx = em.getTransaction();
		tx.begin();

		em.merge(pers);
		       
		
		System.out.println("After update \n firstname in database =" + subscriberDAO.GetSingleSubscriberByLastName("Airo").getFirstName());
		System.out.println(" subscriber variable firstname =" + subscriber.getFirstName());
		System.out.println(" pers variable firstname =" + pers.getFirstName());

		em.merge(subscriber);
		       
		
		System.out.println("After 2nd update \n firstname in database =" + subscriberDAO.GetSingleSubscriberByLastName("Airo").getFirstName());
		System.out.println(" subscriber variable firstname =" + subscriber.getFirstName());
		System.out.println(" pers variable firstname =" + pers.getFirstName());

		tx.commit();
		JPAUtil.closeEntityManager();
	}
	
	
	
	@Test
	public void testManyToOnePartOfBidirectionalAssociationUpdate1() throws SubscriberExistsException {

		
		EntityManager em;
		EntityTransaction tx;
		
		Entitled e;
		Subscriber s1, s2;
		
		em = JPAUtil.getEntityManager();
		tx =em.getTransaction();
		tx.begin();

		e=(Entitled)subscriberDAO.get(3);
		s1= subscriberDAO.get(1);
		s2= subscriberDAO.get(2);


		System.out.println("Before update\n Subscriber "+ s1 +" has entitles "+ s1.getEntitles());
		System.out.println(" Subscriber "+ s2 +" has entitles "+ s2.getEntitles());
		e.setMainSubscriber(s1);
		System.out.println("After update\n Subscriber "+ s1 +" has entitles "+ s1.getEntitles());
		System.out.println(" Subscriber "+ s2 +" has entitles "+ s2.getEntitles());


		tx.commit();
		JPAUtil.closeEntityManager();

		

		System.out.println("After commit\n Subscriber "+ s1 +" has entitles "+ s1.getEntitles());
		System.out.println(" Subscriber "+ s2 +" has entitles "+ s2.getEntitles());


	}

	@Test
	public void testManyToOnePartOfBidirectionalAssociationUpdate2() throws SubscriberExistsException {

		
		EntityManager em;
		EntityTransaction tx;
		
		Entitled e;
		Subscriber s1, s2;
		
		em = JPAUtil.getEntityManager();
		tx =em.getTransaction();
		tx.begin();

		e=(Entitled)subscriberDAO.get(3);
		s1= subscriberDAO.get(1);
		s2= subscriberDAO.get(2);

		System.out.println("Before update\n Subscriber "+ s1 +" has entitles "+ s1.getEntitles());
		System.out.println(" Subscriber "+ s2 +" has entitles "+ s2.getEntitles());

		e.setMainSubscriber(s1);

		tx.commit();
		JPAUtil.closeEntityManager();

		System.out.println("After update\n Subscriber "+ s1 +" has entitles "+ s1.getEntitles());
		System.out.println(" Subscriber "+ s2 +" has entitles "+ s2.getEntitles());

		em = JPAUtil.getEntityManager();
		tx =em.getTransaction();
		tx.begin();		

		s1= subscriberDAO.get(1);
		s2= subscriberDAO.get(2);

		System.out.println("After commit and reload\n Subscriber "+ s1 +" has entitles "+ s1.getEntitles());
		System.out.println(" Subscriber "+ s2 +" has entitles "+ s2.getEntitles());

		tx.commit();
		JPAUtil.closeEntityManager();


	}

	
	@Test
	public void testOneTOManyPartOfBidirectionalAssociationUpdate() throws SubscriberExistsException {

		EntityManager em;
		EntityTransaction tx;
		
		Entitled e;
		Subscriber s1, s2;
		
		em = JPAUtil.getEntityManager();
		tx =em.getTransaction();
		tx.begin();

		e=(Entitled)subscriberDAO.get(3);
		s1= subscriberDAO.get(1);
		s2= subscriberDAO.get(2);

		System.out.println("Before update\n Subscriber "+ s1 +" has entitles "+ s1.getEntitles());
		System.out.println(" Subscriber "+ s2 +" has entitles "+ s2.getEntitles());

		s1.addEntitled(e);

		tx.commit();
		JPAUtil.closeEntityManager();

		System.out.println("After update\n Subscriber "+ s1 +" has entitles "+ s1.getEntitles());
		System.out.println(" Subscriber "+ s2 +" has entitles "+ s2.getEntitles());

		em = JPAUtil.getEntityManager();
		tx =em.getTransaction();
		tx.begin();		

		s1= subscriberDAO.get(1);
		s2= subscriberDAO.get(2);

		System.out.println("After commit and reload\n Subscriber "+ s1 +" has entitles "+ s1.getEntitles());
		System.out.println(" Subscriber "+ s2 +" has entitles "+ s2.getEntitles());

		tx.commit();
		JPAUtil.closeEntityManager();



	}

	
	
	@Test (expected=LazyInitializationException.class)
	public void testAssociationUpdateOutOfTransaction() throws SubscriberExistsException {

		EntityManager em;
		EntityTransaction tx;
		
		Entitled e;
		Subscriber s1, s2;
		
		em = JPAUtil.getEntityManager();
		tx =em.getTransaction();
		tx.begin();

		e=(Entitled)subscriberDAO.get(3);
		s1= subscriberDAO.get(1);
		s2= subscriberDAO.get(2);

		tx.commit();
		JPAUtil.closeEntityManager();

		System.out.println("After commit and Before update\n Subscriber "+ s1 +" has entitles "+ s1.getEntitles());
		System.out.println(" Subscriber "+ s2 +" has entitles "+ s2.getEntitles());

		e.setMainSubscriber(s1);

		System.out.println("After commit and After update\n Subscriber "+ s1 +" has entitles "+ s1.getEntitles());
		System.out.println(" Subscriber "+ s2 +" has entitles "+ s2.getEntitles());


		em = JPAUtil.getEntityManager();
		tx =em.getTransaction();
		tx.begin();

		em.merge(e);
		em.merge(s1);
		em.merge(s2);

		System.out.println("After commit and reload\n Subscriber "+ s1 +" has entitles "+ s1.getEntitles());
		System.out.println(" Subscriber "+ s2 +" has entitles "+ s2.getEntitles());

		tx.commit();
		JPAUtil.closeEntityManager();

	}

	

}
