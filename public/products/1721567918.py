import firebase_admin
from firebase_admin import credentials,auth,db

cred = credentials.Certificate("ameni-hammami-firebase-adminsdk-s70pe-c249060f08.json")
firebase_admin.initialize_app(cred, {'databaseURL': 'https://ameni-hammami-default-rtdb.firebaseio.com/'})


ref = db.reference('/')
ref.set({
"emploi":{
  'emp1':{"first":"2", "last":"0"}
}
})

