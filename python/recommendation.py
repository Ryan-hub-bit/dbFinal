import pandas as pd
import numpy as np
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.metrics.pairwise import linear_kernel
import warnings; warnings.simplefilter('ignore')
import mysql.connector
from sqlalchemy import create_engine

def get_recommendations(n_rec=10):
    #Connect to Database
    url = 'mysql://root:rootroot@127.0.0.1/db'
    engine = create_engine(url, echo=False)

    #Get favorite and movies
    qryFav = 'SELECT D.movie_id, D.tagline FROM watchedMovies AS W, mDetail AS D WHERE W.Watched_movie_id = D.movie_id AND W.user_id = 1'
    qryMov = 'SELECT D.movie_id, D.tagline FROM mDetail AS D'
    
    fav = pd.read_sql(qryFav, engine)
    mov = pd.read_sql(qryMov, engine)
    rec = recommend(n_rec, mov, fav)
    
    #rec.to_sql(name='recommendations', con=engine, if_exists = 'replace', index=True)
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
    url = 'mysql://root:rootroot@127.0.0.1/db'
    engine = create_engine(url, echo=False)	

    qryMov = 'SELECT D.movie_id, D.tagline FROM mDetail AS D'
    mov = pd.read_sql(qryMov, engine)

    return mov


if __name__ == "__main__":
    test_connection()