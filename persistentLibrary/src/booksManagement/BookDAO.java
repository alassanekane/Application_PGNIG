/**
 * 
 */
package booksManagement;

import java.util.List;
import exceptions.*;
import booksManagement.Book;
import jpaUtils.JPAUtil;
import javax.persistence.EntityManager;

/** 
 * @author user
 */
public class BookDAO {




	public boolean isEmpty(){
		EntityManager entityManager=JPAUtil.getEntityManager();
		if (entityManager.createNamedQuery("findAllBooks").getResultList().isEmpty())
			return true;
		else
			return false;	
	}





	/**
	 */
	public List<Book> getContent(){
		EntityManager entityManager=JPAUtil.getEntityManager();
		return ((List<Book>)entityManager.createNamedQuery("findAllBooks").getResultList());
	}






	public boolean add(Book book){
			EntityManager entityManager=JPAUtil.getEntityManager();
	try{
				entityManager.persist(book);
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
			List<Book> theBooks = (List<Book>) entityManager.createNamedQuery("findAllBooks").getResultList();
			for (Book b : theBooks)
				result += b.toString()+ "\n";
					return result;
		}







		/**
		 */
		public Book get(long bookId) throws BookExistsException {
			EntityManager entityManager=JPAUtil.getEntityManager();
			Book b = (Book) entityManager.find(Book.class, bookId);
			if (b ==null) throw new BookExistsException();
			else return b;
		}






		/**
		 */
		public long size(){
			EntityManager entityManager=JPAUtil.getEntityManager();
			return (entityManager.createNamedQuery("findAllBooks").getResultList().size());
		}






		/**
		 */
		public boolean remove(Book book) throws BookExistsException {
			EntityManager entityManager=JPAUtil.getEntityManager();
			if (book== null) 
				throw new BookExistsException(); 
			else 
				try{
					entityManager.remove(book);
				} catch (Exception pe) {
					System.err.println("problem when deleting an entity ");
					pe.printStackTrace();
					return false;
				}
			return true;	
		}





			
			/**
			 */
			public boolean contains(Book book) throws BookExistsException {
				EntityManager entityManager=JPAUtil.getEntityManager();
				if (book == null) throw new BookExistsException();
				Book b = (Book) entityManager.find(Book.class, book.getIsbn());
				if (b ==null) return false;
				else return b.equals(book);	
			}

}


