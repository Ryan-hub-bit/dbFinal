import pandas as pd
import numpy as np
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.metrics.pairwise import linear_kernel
import warnings; warnings.simplefilter('ignore')
import mysql.connector

def get_recommendations(userID, n_rec=10):
    #Connect to Database
    cnx = mysql.connector.connect(host='localhost',database='db',user='root',password='rootroot')
    cursor1 = cnx.cursor1()
    cursor2 = cnx.cursor2()

    print('Connection Successful')
    
    #Get favorite and movies
    qryFav = 'SELECT D.movie_id, D.tagline FROM watchedMovies AS W, mDetail AS D WHERE W.Watched_movie_id = D.movie_id AND W.user_id = ' + str(userID)
    qryMov = 'SELECT D.movie_id, D.tagline FROM mDetail AS D'
    
    cursor1.execute(qryMov)
    cursor2.execute(qryFav)
    mov = pd.DataFrame(data=list(cursor1), columns = cursor1.column_names)
    fav = pd.DataFrame(data=list(cursor2), columns = cursor2.column_names)
    
    cursor1.close()
    cursor2.close()
    
    print('Query Successful')
    
    #Data processing
    mov['tagline'] = mov['tagline'].fillna('')
    fav['tagline'] = fav['tagline'].fillna('')
    
    fav = pd.read_sql(qryFav, engine)
    mov = pd.read_sql(qryMov, engine)
    rec = recommend(n_rec, mov, fav)
    
    print('Processing Successful')
    
    #Write to recommendations table
    rec.to_sql(name='recommendations', con=cnx, if_exists = 'replace', index=True)
    cnx.close()
    
    print('Write Successful')
    
    return rec


def recommend(n_rec, mov, fav):
    #similarity analysis
    tf = TfidfVectorizer(analyzer='word', ngram_range=(1, 2), min_df=0, stop_words='english')
    tfidf_mov = tf.fit_transform(mov['tagline'])
    sim = linear_kernel(tfidf_mov, tfidf_mov)

    mov = mov.reset_index()
    ttl = mov['movie_id']
    idx = pd.Series(mov.index, index=mov['movie_id'])
    
    #recommendation on favorites
    title = fav['movie_id']
    sim_scores = np.array(sim[idx[title]]) 
    avg_scores = np.average(sim_scores, axis=0)
    avg_scores = list(enumerate(avg_scores))
    avg_scores = sorted(avg_scores, key=lambda x: x[1], reverse=True)
    avg_scores = avg_scores[title.size:title.size+n_rec]
    movie_idx = [i[0] for i in avg_scores]
    movie_rec = ttl.iloc[movie_idx].to_frame()
    movie_rec['score'] = [i[1]*100 for i in avg_scores]
    
    return movie_rec


def test_connection():
    #Connect to Database
    cnx = mysql.connector.connect(host='localhost',database='db',user='root',password='rootroot')	

    cursor = cnx.cursor()
    cursor.execute('SELECT D.movie_id, D.tagline FROM mDetail AS D')
    mov = pd.DataFrame(data=list(cursor),columns = cursor.column_names)
    cnx.close()

    print('Connection Successful') 

    return mov


if __name__ == "__main__":
    test_connection()