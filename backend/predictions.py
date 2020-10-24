from sklearn.neural_network import MLPRegressor

class Predictions :

    def __init__ (self):
        self.mlp = MLPRegressor(random_state=1, max_iter=500)

    # Prédictions des cas par semaine en utilisant Multi-Layer Perceptron
    def WeekPrediction(self, x_train, y_train, x):
        mlp_regr = self.mlp.fit(x_train, y_train)
        return mlp_regr.predict(x[:2])

