

import java.util.ArrayList;
import java.util.Calendar;

import loansManagement.Loan;

public class Media {

	
	public class MediaDAO {

	}


	/**
	 * @uml.property  name="id_media"
	 */
	private String id_media;

	/**
	 * Getter of the property <tt>id_media</tt>
	 * @return  Returns the id_media.
	 * @uml.property  name="id_media"
	 */
	public String getId_media() {
		return id_media;
	}

	/**
	 * Setter of the property <tt>id_media</tt>
	 * @param id_media  The id_media to set.
	 * @uml.property  name="id_media"
	 */
	public void setId_media(String id_media) {
		this.id_media = id_media;
	}

	/**
	 * @uml.property  name="editionDate"
	 */
	private Calendar editionDate;

	/**
	 * Getter of the property <tt>editionDate</tt>
	 * @return  Returns the editionDate.
	 * @uml.property  name="editionDate"
	 */
	public Calendar getEditionDate() {
		return editionDate;
	}

	/**
	 * Setter of the property <tt>editionDate</tt>
	 * @param editionDate  The editionDate to set.
	 * @uml.property  name="editionDate"
	 */
	public void setEditionDate(Calendar editionDate) {
		this.editionDate = editionDate;
	}

	/** 
	 * @uml.property name="auteurs"
	 */
	private ArrayList auteurs;

	/** 
	 * Getter of the property <tt>auteurs</tt>
	 * @return  Returns the auteurs.
	 * @uml.property  name="auteurs"
	 */
	public ArrayList getAuteurs() {
		return auteurs;
	}

	/** 
	 * Setter of the property <tt>auteurs</tt>
	 * @param auteurs  The auteurs to set.
	 * @uml.property  name="auteurs"
	 */
	public void setAuteurs(ArrayList auteurs) {
		this.auteurs = auteurs;
	}

		
		/**
		 */
		public void equals(){
		}

			
				
				
				public boolean isLent(){
					return false;	
				}

				
					
					
					public void retourMedia(){
					}

					
						
						/**
						 */
						public void lent(Loan loan){
						}

						
						/**
						 */
						public String toString(){
							return "";	
						}

}
