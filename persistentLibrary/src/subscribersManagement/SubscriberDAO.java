package subscribersManagement;

import java.util.List;
import exceptions.*;
import subscribersManagement.Subscriber;
import javax.persistence.EntityManager;
import javax.persistence.EntityTransaction;
import javax.persistence.Query;



import jpaUtils.JPAUtil;






public class SubscriberDAO {



	/** 
		 */
		public boolean isEmpty(){
			EntityManager entityManager=JPAUtil.getEntityManager();
			if (entityManager.createNamedQuery("findAllSubscribers").getResultList().isEmpty())
				return true;
			else
				return false;	
		}





		public boolean add(Subscriber subscriber){
			EntityManager entityManager=JPAUtil.getEntityManager();
			try{
				entityManager.persist(subscriber);
			} catch (Exception e) {
				System.err.println("Problem when saving");
				e.printStackTrace();
				return false;
			}
			return true;
		}

		public boolean add(Entitled entitled){
			EntityManager entityManager=JPAUtil.getEntityManager();
			try{
				entityManager.persist(entitled);
			} catch (Exception e) {
				System.err.println("Problem when saving");
				e.printStackTrace();
				return false;
			}
			return true;
		}








		public String toString(){
			EntityManager entityManager=JPAUtil.getEntityManager();
			String result="";
			List<Subscriber> theSubscribers = (List<Subscriber>) entityManager.createNamedQuery("findAllSubscribers").getResultList();
			for (Subscriber s : theSubscribers)
				result += s.toString()+ "\n";
					return result;
		}







		/**
		 */
		public Subscriber get(long subscriberId) throws SubscriberExistsException {
			EntityManager entityManager=JPAUtil.getEntityManager();
			Subscriber s = (Subscriber) entityManager.find(Subscriber.class, subscriberId);
			if (s ==null) throw new SubscriberExistsException();
			else return s;
		}






		/**
		 */
		public long size(){
			EntityManager entityManager=JPAUtil.getEntityManager();
			return (entityManager.createNamedQuery("findAllSubscribers").getResultList().size());
		}






		/**
		 */
		public boolean remove(Subscriber subscriber) throws SubscriberExistsException {
			EntityManager entityManager=JPAUtil.getEntityManager();
			if (subscriber== null) 
				throw new SubscriberExistsException(); 
			else 
				try{
					entityManager.remove(subscriber);
				} catch (Exception pe) {
					System.err.println("problem when deleting an entity ");
					pe.printStackTrace();
					return false;
				}
			return true;	
		}





			
			/**
			 */
			public boolean contains(Subscriber subscriber) throws SubscriberExistsException {
				EntityManager entityManager=JPAUtil.getEntityManager();
				if (subscriber == null) throw new SubscriberExistsException();
				Subscriber s = (Subscriber) entityManager.find(Subscriber.class, subscriber.getNumber());
				if (s ==null) return false;
				else return s.equals(subscriber);	
			}

			/**
			 */
			public List<Subscriber> getContent(){
				EntityManager entityManager=JPAUtil.getEntityManager();
				return ((List<Subscriber>)entityManager.createNamedQuery("findAllSubscribers").getResultList());
			}





				
				/**
				 */
				public Subscriber GetSingleSubscriberByLastName(String lastName) throws SubscriberExistsException {
					EntityManager em = JPAUtil.getEntityManager();
					Query query = em.createQuery("select s from Subscriber s where s.lastName='"+lastName+"'");
					Subscriber subscriber = (Subscriber) query.getSingleResult();
					if (subscriber == null) throw new SubscriberExistsException();
					else
						return subscriber;
				}
}
