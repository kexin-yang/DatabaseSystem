import java.io.File
import kotlin.random.Random

/* Schema:
ID
Job Title
Organization
Division
Position Type
Internal Status
App Deadline
*/

fun main() {
    val jobs = mutableListOf<Job>()

    var currentJob = Job()
    File("jobs.txt").forEachLine { line ->
        if (line.startsWith("View  Shortlist Apply")) {
            val formattedString = line.removePrefix("View  Shortlist Apply\t\t");
            currentJob.ID = formattedString.substring(0, 6).toInt()
            currentJob.JobTitle = formattedString.substring(7, formattedString.length)
        } else {
            val remainingData = line.split("\t")
            currentJob.Organization = remainingData[0]
            currentJob.Division = remainingData[1]
            currentJob.PositionType = remainingData[2]
            currentJob.InternalStatus = remainingData[3]
            currentJob.AppDeadline = remainingData[4]
            jobs.add(currentJob)
            currentJob = Job()
        }
    }

//    jobs.forEach {
//        println(it.ID.toString() + "\t" + it.JobTitle + "\t" + it.Organization + "\t" + it.Division + "\t" + it.PositionType + "\t" + it.InternalStatus + "\t" + it.AppDeadline + "\t" + it.Description)
//    }

    val companies = mutableListOf<Company>()
    jobs.forEach { job ->
        if (!companies.any { it.Organization == job.Organization }) {
            companies.add(Company(job.Organization, Random.nextInt(1, 101) / 10.0F))
        }
    }
    companies.forEach {
        println(it.Organization + "\t" + it.Rating)
    }
}

data class Job(
    var ID: Int = 0, // primary key
    var JobTitle: String = "",
    var Organization: String = "",
    var Division: String = "",
    var PositionType: String = "",
    var InternalStatus: String = "",
    var AppDeadline: String = "",
    var Description: String = "This is an awesome job."
)

data class Company(
    var Organization: String = "",
    var Rating: Float = 0.0F
)

//App Status
//ID
//Job Title
//Organization
//Division
//Position Type
//Internal Status
//App Deadline