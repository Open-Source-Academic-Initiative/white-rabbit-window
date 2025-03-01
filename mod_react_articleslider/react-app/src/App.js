/* import logo from './logo.svg';
import './App.css';

function App() {
  return (
    <div className="App">
      <header className="App-header">
        <img src={logo} className="App-logo" alt="logo" />
        <p>
          Edit <code>src/App.js</code> and save to reload.
        </p>
        <a
          className="App-link"
          href="https://reactjs.org"
          target="_blank"
          rel="noopener noreferrer"
        >
          Learn React
        </a>
      </header>
    </div>
  );
}

export default App; */

import React, { useEffect, useState } from "react";
import axios from "axios";
import "bootstrap/dist/css/bootstrap.min.css";
import "./App.css";

const App = () => {
    const [articles, setArticles] = useState([]);

    useEffect(() => {
        const fetchArticles = async () => {
            try {
                const response = await axios.get(
                    "/api/index.php/v1/content/articles?catid=30&limit=5"
                );
                setArticles(response.data.data);
            } catch (error) {
                console.error("Error fetching articles:", error);
            }
        };

        fetchArticles();
    }, []);

    return (
        <div className="article-slider">
            <div className="slider">
                {articles.map((article, index) => {
                    const image = article.images
                        ? JSON.parse(article.images).image_intro
                        : "default.jpg";
                    
                    return (
                        <div className="card" key={index}>
                            <img src={image} className="card-img-top" alt={article.title} />
                            <div className="card-body">
                                <h5 className="card-title">{article.title}</h5>
                                <p className="card-text">
                                    {article.introtext.substring(0, 100)}...
                                </p>
                                <a
                                    href={`/index.php?option=com_content&view=article&id=${article.id}`}
                                    target="_blank"
                                    className="btn btn-primary"
                                >
                                    Read More
                                </a>
                            </div>
                        </div>
                    );
                })}
            </div>
        </div>
    );
};

export default App;

