from flask import Flask
from response import Response
from flask_cors import CORS
from predictions import Predictions
from sklearn.datasets import make_regression
from sklearn.model_selection import train_test_split
import requests
import json
app = Flask(__name__)
CORS(app)

response = Response()

@app.route('/')
def index():
    f = open('index.html')
    return " ".join(f.readlines())

# Préparation des données journalier Covid-19 Maroc
def prepareData():
    result = []
    data = json.loads(requests.get("https://api.covid19api.com/country/Morocco").content)
    i = 0
    for d in data:
        if i == 0 : 
            result.append({
                "Date" : d["Date"],
                "Confirmed" : d["Confirmed"],
                "Deaths" : d["Deaths"],
                "Recovered" : d["Recovered"]
            })
        else :
            result.append({
                "Date" : d["Date"],
                "Confirmed" : d["Confirmed"] - data[i-1]["Confirmed"],
                "Deaths" : d["Deaths"] - data[i-1]["Deaths"],
                "Recovered" : d["Recovered"] - data[i-1]["Recovered"]
            })
        i += 1
    return result

# Séparer les données de test et d'entraînement
def splitData(data):
    nb_total = len(data)
    nb_train = nb_total - int(nb_total / 10)
    return list(data[:nb_train]), list(data[nb_train:nb_total])

# Prediction des cas dans une semaine
def MLPWeekPrediction():
    X, y = make_regression(n_samples=200, random_state=1)
    X_train, X_test, y_train, y_test = train_test_split(X, y,
                                                        random_state=1)
    predictions = Predictions()
    return predictions.WeekPrediction(X_train, y_train, X_test)

# Prédiction des cas par régions dans une semaine
def MLPWeekPerRegion():
    pass

# La route pour accéder au prédiction par semain
@app.route('/week')
def week():
    train_set, test_set = splitData(prepareData())
    data = {
        "prediction" : [
            str(len(train_set)) + ", " + str(len(test_set))
        ]
    }
    return response.json(data)

# La route pour accéder au prédiction par région 
@app.route('/region/<name>')
def region(name):
    data = {
        "prediction" : ["Vous avez choisi : "+name]
    }
    return response.json(data)
