import json

class Response :

    def json(self, obj, code=200, status="OK"):
        return "{\"code\" : " + str(code) +", \"status\" : \""+str(status)+"\", \"body\" : "+json.dumps(obj)+"}"
