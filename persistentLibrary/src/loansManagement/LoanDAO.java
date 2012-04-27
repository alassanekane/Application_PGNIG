package loansManagement;

import java.util.List;

import javax.persistence.EntityManager;

import jpaUtils.JPAUtil;
import exceptions.LoanExistsException;


public class LoanDAO {
	
	public boolean isEmpty(){
		EntityManager entityManager=JPAUtil.getEntityManager();
		if (entityManager.createNamedQuery("findAllLoans").getResultList().isEmpty())
			return true;
		else
			return false;	
	}





	/**
	 */
	public List<Loan> getContent(){
		EntityManager entityManager=JPAUtil.getEntityManager();
		return ((List<Loan>)entityManager.createNamedQuery("findAllLoans").getResultList());
	}






	public boolean add(Loan loan){
			EntityManager entityManager=JPAUtil.getEntityManager();
	try{
				entityManager.persist(loan);
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
			List<Loan> theLoans = (List<Loan>) entityManager.createNamedQuery("findAllLoans").getResultList();
			for (Loan b : theLoans)
				result += b.toString()+ "\n";
					return result;
		}







		/**
		 */
//		public Book get(long bookId) throws BookExistsException {
//			EntityManager entityManager=JPAUtil.getEntityManager();
//			Book b = (Book) entityManager.find(Book.class, bookId);
//			if (b ==null) throw new BookExistsException();
//			else return b;
//		}


		/**
		 */
		public long size(){
			EntityManager entityManager=JPAUtil.getEntityManager();
			return (entityManager.createNamedQuery("findAllLooks").getResultList().size());
		}






		/**
		 */
		public boolean remove(Loan loan) throws LoanExistsException {
			EntityManager entityManager=JPAUtil.getEntityManager();
			if (loan== null) 
				throw new LoanExistsException(); 
			else 
				try{
					entityManager.remove(loan);
				} catch (Exception pe) {
					System.err.println("problem when deleting an entity ");
					pe.printStackTrace();
					return false;
				}
			return true;	
		}





			
			/**
			 */
//			public boolean contains(Book book) throws BookExistsException {
//				EntityManager entityManager=JPAUtil.getEntityManager();
//				if (book == null) throw new BookExistsException();
//				Book b = (Book) entityManager.find(Book.class, book.getIsbn());
//				if (b ==null) return false;
//				else return b.equals(book);	
//			}

	
	
}
